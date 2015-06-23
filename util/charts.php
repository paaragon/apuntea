
<?php

trait charts {

    //Usuarios registrados en los últimos 7 meses
    function usuariosMeses() {
        setlocale(LC_ALL, 'esp');

        $month = time();
        for ($i = 1; $i <= 7; $i++) {
            $month = strtotime('last month', $month);
            $months[] = array("name" => strftime("%B", $month), "number" => strftime("%m", $month));
        }

        foreach ($months as $m) {
            $result[$m["name"]] = R::count('usuario', 'MONTH(fecha) = ? AND TIMESTAMPDIFF(MONTH, NOW(), fecha) >= -6', [$m["number"]]);
        }

        $result = array_reverse($result);

        $primer_mes = key($result);
        $primer_valor = array_shift($result);

        $chart["label"] = $etiquetas1 = '"' . $primer_mes . '"';
        $chart["data"] = $primer_valor;

        foreach ($result as $month => $value) {

            $chart["label"] .= ', "' . $month . '"';
            $chart["data"] .=', ' . $value;
        }

        return $chart;
    }

    // Apuntes por universidad (%)
    function apuntesPorUniversidades() {

        $result = R::getAll('SELECT universidad.siglas, COUNT(*) / (SELECT COUNT(*) / 100 FROM apunte) as num FROM universidad, carrera, asignatura, apunte WHERE universidad.id = universidad_id AND carrera.id = carrera_id AND asignatura.id = asignatura_id GROUP BY universidad.id ORDER BY num DESC');

        $elem = array_shift($result);

        $i = 1;
        $chart["data"] = '{value: ' . $elem["num"] . ', color: "rgba(70, 181, 82, ' . $i . ')", highlight: "rgba(70, 181, 82, ' . ($i - 0.1) . ')", label: "' . $elem["siglas"] . '" }';
        foreach ($result as $elem) {
            $i -= 0.2;
            $chart["data"] .= ',{value: ' . $elem["num"] . ', color: "rgba(70, 181, 82, ' . $i . ')", highlight: "rgba(70, 181, 82, ' . ($i - 0.1) . ')", label: "' . $elem["siglas"] . '" }';
        }

        return $chart;
    }

    // Apuntes en los últimos 7 meses
    function apuntesMeses() {
        setlocale(LC_ALL, 'esp');

        $month = time();
        for ($i = 1; $i <= 7; $i++) {
            $month = strtotime('last month', $month);
            $months[] = array("name" => strftime("%B", $month), "number" => strftime("%m", $month));
        }

        foreach ($months as $m) {
            $result[$m["name"]] = R::count('apunte', 'MONTH(fecha) = ? AND TIMESTAMPDIFF(MONTH, NOW(), fecha) >= -6', [$m["number"]]);
        }

        $result = array_reverse($result);

        $primer_mes = key($result);
        $primer_valor = array_shift($result);

        $chart["label"] = '"' . $primer_mes . '"';
        $chart["data"] = $primer_valor;

        foreach ($result as $month => $value) {

            $chart["label"] .= ', "' . $month . '"';
            $chart["data"] .=', ' . $value;
        }

        return $chart;
    }

    // Ranking de usuarios con más apuntes
    function usuariosConMasApuntes() {
        $result = R::getAll("SELECT nick, COUNT(*) as num FROM usuario, apunte WHERE usuario.id = apunte.usuario_id GROUP BY nick ORDER BY num DESC limit 5");

        $primer_elemento = array_shift($result);

        $chart["label"] = '"' . $primer_elemento["nick"] . '"';
        $chart["data"] = $primer_elemento["num"];

        foreach ($result as $elem) {

            $chart["label"] .= ', "' . $elem["nick"] . '"';
            $chart["data"] .=', ' . $elem["num"];
        }

        return $chart;
    }

    // Apuntes de usuario en los dos últimos meses
    function numApuntesDeUsuario($idUsuario) {

        setlocale(LC_ALL, 'esp');

        $month = time();
        for ($i = 1; $i <= 2; $i++) {
            $month = strtotime('last month', $month);
            $months[] = array("name" => strftime("%B", $month), "number" => strftime("%m", $month));
        }

        foreach ($months as $m) {
            $result[$m["name"]] = R::count('apunte', 'usuario_id = ? AND MONTH(fecha) = ? AND TIMESTAMPDIFF(MONTH, NOW(), fecha) >= -1', [$idUsuario, $m["number"]]);
        }

        $result = array_reverse($result);

        $primer_mes = key($result);
        $primer_valor = array_shift($result);

        $chart["label"] = '"' . $primer_mes . '"';
        $chart["data"] = $primer_valor;

        foreach ($result as $month => $value) {

            $chart["label"] .= ', "' . $month . '"';
            $chart["data"] .=', ' . $value;
        }

        return $chart;
    }

    // Apuntes más populares de un usuario
    function apuntesMasPopulares($idUsuario) {
        $result = R::getAll("SELECT apunte.titulo, apunte.likes FROM apunte, usuario WHERE apunte.usuario_id = usuario.id AND usuario_id = ? ORDER BY apunte.likes DESC limit 5", [$idUsuario]);

        $primer_elemento = array_shift($result);

        $chart["label"] = '"' . $primer_elemento["titulo"] . '"';
        $chart["data"] = $primer_elemento["likes"];

        foreach ($result as $elem) {

            $chart["label"] .= ', "' . $elem["titulo"] . '"';
            $chart["data"] .=', ' . $elem["likes"];
        }

        return $chart;
    }

    //Número de likes en las últimas semanas
    function numLikes($idApunte) {
        setlocale(LC_ALL, 'esp');

        $month = time();
        for ($i = 1; $i <= 7; $i++) {
            $month = strtotime('last month', $month);
            $months[] = array("name" => strftime("%B", $month), "number" => strftime("%m", $month));
        }

        foreach ($months as $m) {
            $result[$m["name"]] = R::count('usuariointeractuaapunte', 'MONTH(fechalike) = ? AND TIMESTAMPDIFF(MONTH, NOW(), fechalike) >= -6 AND apunte_id = ?', [$m["number"], $idApunte]);
        }

        $result = array_reverse($result);

        $primer_mes = key($result);
        $primer_valor = array_shift($result);

        $chart["label"] = '"' . $primer_mes . '"';
        $chart["data"] = $primer_valor;

        foreach ($result as $month => $value) {

            $chart["label"] .= ', "' . $month . '"';
            $chart["data"] .=', ' . $value;
        }

        return $chart;
    }

    function numDislikes($idApunte) {
        setlocale(LC_ALL, 'esp');

        $month = time();
        for ($i = 1; $i <= 7; $i++) {
            $month = strtotime('last month', $month);
            $months[] = array("name" => strftime("%B", $month), "number" => strftime("%m", $month));
        }

        foreach ($months as $m) {
            $result[$m["name"]] = R::count('usuariointeractuaapunte', 'MONTH(fechadislike) = ? AND TIMESTAMPDIFF(MONTH, NOW(), fechadislike) >= -6 AND apunte_id = ?', [$m["number"], $idApunte]);
        }

        $result = array_reverse($result);

        $primer_mes = key($result);
        $primer_valor = array_shift($result);

        $chart["label"] = '"' . $primer_mes . '"';
        $chart["data"] = $primer_valor;

        foreach ($result as $month => $value) {

            $chart["label"] .= ', "' . $month . '"';
            $chart["data"] .=', ' . $value;
        }

        return $chart;
    }

    function numFavs($idApunte) {
        setlocale(LC_ALL, 'esp');

        $month = time();
        for ($i = 1; $i <= 7; $i++) {
            $month = strtotime('last month', $month);
            $months[] = array("name" => strftime("%B", $month), "number" => strftime("%m", $month));
        }

        foreach ($months as $m) {
            $result[$m["name"]] = R::count('usuariointeractuaapunte', 'MONTH(fechafav) = ? AND TIMESTAMPDIFF(MONTH, NOW(), fechafav) >= -6 AND apunte_id = ?', [$m["number"], $idApunte]);
        }

        $result = array_reverse($result);

        $primer_mes = key($result);
        $primer_valor = array_shift($result);

        $chart["label"] = '"' . $primer_mes . '"';
        $chart["data"] = $primer_valor;

        foreach ($result as $month => $value) {

            $chart["label"] .= ', "' . $month . '"';
            $chart["data"] .=', ' . $value;
        }

        return $chart;
    }

    function gruposConMasParticipantes() {
        $sql = "SELECT grupo.id, grupo.nombre as nombre, COUNT(usuariogrupo.usuario_id) as num FROM usuariogrupo, grupo WHERE grupo.id = grupo_id AND usuariogrupo.admitido=1 GROUP BY usuariogrupo.grupo_id ORDER BY num DESC LIMIT 5";
        $result = R::getAll($sql);

        $primer_grupo = array_shift($result);

        $chart["label"] = '"' . $primer_grupo["nombre"] . '"';
        $chart["data"] = $primer_grupo["num"];

        foreach ($result as $grupo) {

            $chart["label"] .= ', "' . $grupo["nombre"] . '"';
            $chart["data"] .= ', ' . $grupo["num"];
        }

        return $chart;
    }

    function gruposConMasApuntes() {
        $sql = "SELECT apuntegrupo.grupo_id as grupo_id, grupo.nombre, COUNT(apuntegrupo.apunte_id) as num FROM apuntegrupo, grupo WHERE grupo.id = grupo_id GROUP BY apuntegrupo.grupo_id ORDER BY num DESC LIMIT 5";
        $result = R::getAll($sql);

        $primer_elemento = array_shift($result);

        $chart["label"] = '"' . $primer_elemento["nombre"] . '"';
        $chart["data"] = $primer_elemento["num"];

        foreach ($result as $elem) {

            $chart["label"] .= ', "' . $$elem["nombre"] . '"';
            $chart["data"] .=', ' . $elem["num"];
        }

        return $chart;
    }

    function carrerasApuntes() {
        $result = R::getAll('SELECT carrera.nombre , COUNT(*) / (SELECT COUNT(*) / 100 '
                        . 'FROM apunte) as num FROM carrera, asignatura, apunte WHERE '
                        . 'carrera.id = carrera_id AND asignatura.id = asignatura_id GROUP BY carrera.id ORDER BY num DESC LIMIT 5');

        $elem = array_shift($result);

        $i = 1;
        $chart["data"] = '{value: ' . $elem["num"] . ', color: "rgba(70, 181, 82, ' . $i . ')", highlight: "rgba(70, 181, 82, ' . ($i - 0.1) . ')", label: "' . $elem["nombre"] . '" }';
        foreach ($result as $elem) {
            $i -= 0.2;
            $chart["data"] .= ',{value: ' . $elem["num"] . ', color: "rgba(70, 181, 82, ' . $i . ')", highlight: "rgba(70, 181, 82, ' . ($i - 0.1) . ')", label: "' . $elem["nombre"] . '" }';
        }

        return $chart;
    }

    function carrerasUsuarios() {

        $result = R::getAll('SELECT carrera.nombre , COUNT(*) / (SELECT COUNT(*) / 100 '
                        . 'FROM usuario) as num FROM carrera, usuario WHERE '
                        . 'carrera.id = carrera_id GROUP BY carrera.id ORDER BY num DESC LIMIT 5');

        $elem = array_shift($result);

        $i = 1;
        $chart["data"] = '{value: ' . $elem["num"] . ', color: "rgba(70, 181, 82, ' . $i . ')", highlight: "rgba(70, 181, 82, ' . ($i - 0.1) . ')", label: "' . $elem["nombre"] . '" }';
        foreach ($result as $elem) {
            $i -= 0.2;
            $chart["data"] .= ',{value: ' . $elem["num"] . ', color: "rgba(70, 181, 82, ' . $i . ')", highlight: "rgba(70, 181, 82, ' . ($i - 0.1) . ')", label: "' . $elem["nombre"] . '" }';
        }

        return $chart;
    }

    //Usuarios registrados en una carrera en los ultimos  meses
    function usuariosMesesCarreras($idCarrera) {
        setlocale(LC_ALL, 'esp');

        $month = time();
        for ($i = 1; $i <= 7; $i++) {
            $month = strtotime('last month', $month);
            $months[] = array("name" => strftime("%B", $month), "number" => strftime("%m", $month));
        }

        foreach ($months as $m) {
            $result[$m["name"]] = R::count('usuario', ' carrera_id = ? AND MONTH(fecha) = ? AND TIMESTAMPDIFF(MONTH, NOW(), fecha) >= -6', [$idCarrera, $m["number"]]);
        }

        $result = array_reverse($result);

        $primer_mes = key($result);
        $primer_valor = array_shift($result);

        $chart["label"] = $etiquetas1 = '"' . $primer_mes . '"';
        $chart["data"] = $primer_valor;

        foreach ($result as $month => $value) {

            $chart["label"] .= ', "' . $month . '"';
            $chart["data"] .=', ' . $value;
        }

        return $chart;
    }

    // Apuntes en los últimos 7 meses
    function apuntesMesesCarreras($idCarrera) {
        setlocale(LC_ALL, 'esp');

        $month = time();
        for ($i = 1; $i <= 7; $i++) {
            $month = strtotime('last month', $month);
            $months[] = array("name" => strftime("%B", $month), "number" => strftime("%m", $month));
        }

        foreach ($months as $m) {
            $result[$m["name"]] = R::count('apunte', ' id IN (SELECT apunte.id FROM apunte, asignatura, carrera WHERE asignatura_id = asignatura.id AND carrera_id = carrera.id AND carrera.id = ?) AND MONTH(fecha) = ? AND TIMESTAMPDIFF(MONTH, NOW(), fecha) >= -6', [$idCarrera, $m["number"]]);
        }

        $result = array_reverse($result);

        $primer_mes = key($result);
        $primer_valor = array_shift($result);

        $chart["label"] = '"' . $primer_mes . '"';
        $chart["data"] = $primer_valor;

        foreach ($result as $month => $value) {

            $chart["label"] .= ', "' . $month . '"';
            $chart["data"] .=', ' . $value;
        }

        return $chart;
    }
    
    //Universidades / usuarios (%)
    function universidadesUsuarios() {

        $result = R::getAll('SELECT universidad.siglas , COUNT(*) / (SELECT COUNT(*) / 100 '
                        . 'FROM usuario WHERE carrera_id IS NOT NULL) as num FROM universidad, carrera, usuario WHERE '
                        . 'universidad.id = universidad_id AND carrera.id = carrera_id GROUP BY universidad.id ORDER BY num DESC LIMIT 5');

        $elem = array_shift($result);

        $i = 1;
        $chart["data"] = '{value: ' . $elem["num"] . ', color: "rgba(70, 181, 82, ' . $i . ')", highlight: "rgba(70, 181, 82, ' . ($i - 0.1) . ')", label: "' . $elem["siglas"] . '" }';
        foreach ($result as $elem) {
            $i -= 0.2;
            $chart["data"] .= ',{value: ' . $elem["num"] . ', color: "rgba(70, 181, 82, ' . $i . ')", highlight: "rgba(70, 181, 82, ' . ($i - 0.1) . ')", label: "' . $elem["siglas"] . '" }';
        }

        return $chart;
    }

}
