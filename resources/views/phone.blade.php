<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>

    {!! laravelGeoGenius()->initIntlPhoneInput() !!}

    <form>
        <input id="phone" type="tel" name="phone">
        <button type="submit">Submit</button>
    </form>

</body>
</html>
