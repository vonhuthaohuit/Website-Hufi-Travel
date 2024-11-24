<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    title>JavaScript form validation - Password Checking - 1</title>
    <style>
        li {
            list-style-type: none;
            font-size: 16pt;
        }

        .mail {
            margin: auto;
            padding-top: 10px;
            padding-bottom: 10px;
            width: 400px;
            background:
                #D8F1F8;
            border: 1px soild silver;
        }

        .mail h2 {
            margin-left: 38px;
        }

        input {
            font-size: 20pt;
        }

        input:focus,
        textarea:focus {
            background-color:
                lightyellow;
        }

        input submit {
            font-size: 12pt;
        }

        .rq {
            color:
                #FF0000;
            font-size: 10pt;
        }
    </style>
</head>

<body onload='document.form1.text1.focus()'>
    <div class="mail">
        <h2>Input Password and Submit [7 to 15 characters which contain only characters, numeric digits, underscore and
            first character must be a letter]</h2>
        <form name="form1" action="#">
            <ul>
                <li><input type='text' name='text1' /></li>
                <li class="rq">*Enter numbers only.</li>
                <li>&nbsp;</li>
                <li class="submit"><input type="submit" name="submit" value="Submit"
                        onclick="CheckPassword(document.form1.text1)" /></li>
                <li>&nbsp;</li>
            </ul>
        </form>
    </div>
    <script src="check-password-1.js"></script>
</body>

<script>
    function CheckPassword(inputtxt) {
        var passw = /^[A-Za-z]\w{7,14}$/;
        if (inputtxt.value.match(passw)) {
            alert('Correct, try another...')
            return true;
        } else {
            alert('Wrong...!')
            return false;
        }
    }
</script>

</html>
