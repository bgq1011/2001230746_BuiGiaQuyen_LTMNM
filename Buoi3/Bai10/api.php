<?php
header('Content-Type: application/json');
$file = 'todo.json';

if (!file_exists($file) || filesize($file) == 0) {
    file_put_contents($file, json_encode([]));
}

$content = file_get_contents($file);
$todos = json_decode($content, true);
if (!is_array($todos)) {
    $todos = [];
}

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

if ($method === 'POST') {
    $action = isset($input['action']) ? $input['action'] : '';

    if ($action === 'add' && !empty(trim($input['task']))) {
        $newTodo = [
            'id' => uniqid(), 
            'task' => htmlspecialchars(trim($input['task'])), 
            'completed' => false
        ];
        $todos[] = $newTodo;
        file_put_contents($file, json_encode($todos));
        echo json_encode(['success' => true, 'todo' => $newTodo]);
        exit;
    } 
    
    if ($action === 'toggle') {
        $id = $input['id'];
        foreach ($todos as &$todo) {
            if ($todo['id'] === $id) {
                $todo['completed'] = !$todo['completed'];
                break;
            }
        }
        file_put_contents($file, json_encode($todos));
        echo json_encode(['success' => true]);
        exit;
    } 
    
    if ($action === 'delete') {
        $id = $input['id'];
        $newTodos = [];
        foreach ($todos as $todo) {
            if ($todo['id'] !== $id) {
                $newTodos[] = $todo;
            }
        }
        file_put_contents($file, json_encode($newTodos));
        echo json_encode(['success' => true]);
        exit;
    }
}

// Mặc định trả về danh sách (GET)
echo json_encode($todos);
?>