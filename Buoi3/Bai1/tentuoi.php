<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id ="info"></div>
    <script>
        let name = "Bùi Gia Quyền";
        let age = 20;
        console.log(name);
        console.log(age);
            document.getElementById("info").innerHTML = `Tên: ${name}, Tuổi: ${age}`;
    </script>

</body>
</html>

