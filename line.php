<?php
header('Content-Type: application/json');

// Recibe el número de jugadores desde el servidor FiveM
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['players'])) {
    $count = intval($data['players']);

    $json = json_encode([
        'clients' => $count,
        'updated_at' => date('Y-m-d H:i:s')
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    // Guarda el archivo con el último valor
    file_put_contents('jugadores_live.json', $json);

    echo json_encode(['status' => 'ok', 'players' => $count]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No se recibió ningún dato']);
}
?>
