<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <input type="number" id="age" placeholder="Nhập tuổi">
    <button onclick="checkAge()">Kiểm tra</button>
    <p id="result"></p>

    <script>
        function checkAge() {
            let age = document.getElementById("age").value;
            if (age >= 18) {
                document.getElementById("result").innerText = "Bạn đã đủ tuổi ";

            } else {
                document.getElementById("result").innerText = "Bạn chưa đủ tuổi ";
            }
        }
    </script>
</body>

</html>