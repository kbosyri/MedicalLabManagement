<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Add Elements: [Development Purposes Only]</h1>

    <form method="post" onsubmit="SendData(this)">
        @csrf
        <div id="main-form">
            <input type="submit" value="Submit"> <br>
            <label for="name">Name: <input type="text" name="name" id='name'></label>
            <label for="arabic_name">Arabic Name: <input type="text" name="arabic_name" id='arabic_name'></label>
            <label for="symbol">Symbol: <input type="text" name="symbol" id='symbol'></label>
            <p>Element Type:</p>
            <label for="value_type">Value <input type="radio" name="type" id='value_type'></label>
            <label for="percentage_type">Percentage <input type="radio" name="type" id='percentage_type'></label>
            <label for="exist_type">Exist <input type="radio" name="type" id='exist_type'></label>
        </div>
        <hr>
        <input type="button" value="Add Range" onclick="AddRange()"><br>
        <div id='ranges'>
            <div class='range'>
                <p>Gender:</p>
                none: <input type="radio" name="gender" id="n"><br>
                male <input type="radio" name="gender" value="m"><br>
                female <input type="radio" name="gender" value="f"><br>
                <Label>From Age: <input type="number" name="from_age"></Label><br>
                <label>To Age: <input type="number" name="to_age"></label><br>
                <label>Age Unit <input type="text" name="age_unit"></label><br>
                <label>Unit: <input type="text" name="unit"></label><br>
                <label>Is Range <input type="checkbox" name="is_range"></label><br>
                <label>Is Affected By Gender <input type="checkbox" name="is_affected_by_gender"></label><br>
                <label>Min Value: <input type="number" name="min_value"></label><br>
                <label>Max Value: <input type="number" name="max_value"></label><br>
                <label>Min Possible Value: <input type="number" name="min_possible_value"></label><br>
                <label>Max Possible Value: <input type="number" name="max_possible_value"></label><br>
                <hr>
            </div>
        </div>
    </form>
    <script src="{{URL::asset('js/elements.js')}}"></script>
</body>
</html>