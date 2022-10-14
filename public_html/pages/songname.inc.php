<?php
document::$layout = 'ajax';
if (!empty($_GET['name'])) {
    $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
    if (!empty($url)) {
        $curl = curl_init($url . '/7.html');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36');
        $dados = curl_exec($curl);
        curl_close($curl);

        if (!empty($dados)) {
            // Separates streaming data where there are commas
            $retorno = explode(',', $dados);

            $array['streamingId'] = $retorno[1];
            $array['maxOuvintes'] = $retorno[2];
            $array['limiteOuvintes'] = $retorno[3];
            $array['ouvintes'] = $retorno[4];
            $array['taxaTransmissao'] = $retorno[5];
            $musicaAtual = $retorno[6];

            // If there is a comma in the song information, join the arrays into a string
            if (count($retorno) > 7) {
                $musicaAtual = '';
                for ($i = 6; $i < count($retorno); $i++) {
                    $musicaAtual .= ',' . $retorno[$i];
                }
            }

            // separate artist from track
            $faixaAtual = explode('-', $musicaAtual);

            $artista = $faixaAtual[0];

            if (substr($faixaAtual[0], 0, 1) === ',') {
                $artista = substr($faixaAtual[0], 1, -1);
            }

            // Remover tags html da string
            if (count($faixaAtual) === 2) {
                if (substr($faixaAtual[1], -14) === '</body></html>') {
                    $array['faixa'] = (!empty($faixaAtual[1])) ? trim(substr($faixaAtual[1], 0, -14)) : '...';
                } else {
                    $array['faixa'] = (!empty($faixaAtual[1])) ? $faixaAtual[1] : '...';
                }

                $array['artista'] = (empty($faixaAtual[1])) ? trim(substr($musicaAtual, 0, -14)) : $artista;
            } elseif (count($faixaAtual) < 2) {
                $array['faixa'] = (!empty($musicaAtual)) ? trim(substr($musicaAtual, 0, -14)) : '...';
                $array['artista'] = '...';
            } else {
                $array['faixa'] = trim($faixaAtual[1]);
                $array['artista'] = trim($artista);
            }
        } else {
            $array = ['erro' => 'Falha ao conseguir dados'];
        }
    } else {
        $array = ['erro' => 'Paramentro url nao identificado'];
    }
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json', true);

    echo json_encode($array);
    exit();
}

error_reporting(0);
header('Content-type: text/plain');
header('Pragma: public');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: pre-check=0, post-check=0, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');

if (isset($_POST['ownurl']) && $_POST['ownurl'] != "") :
    echo utf8_encode(htmlentities(html_entity_decode(ownsongtitleURL($_POST['ownurl']), ENT_QUOTES, "ISO-8859-1")));
elseif (isset($_POST['url']) && $_POST['url'] != "") :
    echo utf8_encode(htmlentities(html_entity_decode(shoutcast1($_POST['url']), ENT_QUOTES, "ISO-8859-1")));
else :
    echo "";
endif;
