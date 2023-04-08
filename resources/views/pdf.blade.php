<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @php
    error_log("In View");
    @endphp
    
    <h1>Test Values</h1>
    <h1>نتائج التحاليل</h1>
    <div class="arabic">
        Patinet: <p>{{$values['patient']['first_name']}}</p><br>
        Staff: <p>{{$values['staff']['first_name']}}</p>
    </div>
    Values <p>{{var_dump($values['test'])}}</p>
</body>
</html>