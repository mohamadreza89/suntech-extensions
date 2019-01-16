<!DOCTYPE html>
<html>
<head>
    <title>Userwares</title>
</head>
<body>
    <form method="GET" action="<?php echo $APPROOT; ?>">
        <div>
            <label>Username: </label>
            <input name="Username" type="text" >
        </div>
        <div>
            <label>Class: </label>
            <input name="Class" type="text" >
        </div>
        <div>
            <label>Data: </label>
            <textarea name="Data" type="text"></textarea>
        </div>
        <input type="submit">
    </form>
</body>
</html>

