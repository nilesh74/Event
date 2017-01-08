<html>
<head>
<title>Captcha</title>
    
    <script type="text/javascript">

   //Created / Generates the captcha function    
    function DrawCaptcha()
    {
        var a = Math.ceil(Math.random() * 10)+ '';
        var b = Math.ceil(Math.random() * 10)+ '';       
        var c = Math.ceil(Math.random() * 10)+ '';  
        var d = Math.ceil(Math.random() * 10)+ '';  
        var e = Math.ceil(Math.random() * 10)+ '';  
        var f = Math.ceil(Math.random() * 10)+ '';  
        var g = Math.ceil(Math.random() * 10)+ '';  
        var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e + ' '+ f + ' ' + g;
        document.getElementById("txtCaptcha").value = code
    }

    // Validate the Entered input aganist the generated security code function   
    function ValidCaptcha(){
        var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
        var str2 = removeSpaces(document.getElementById('txtInput').value);
        if (str1 == str2) return true;        
        return false;
        
    }

    // Remove the spaces from the entered and generated code
    function removeSpaces(string)
    {
        return string.split(' ').join('');
    }
    
 
    </script>
    
    
    
</head>
<body onload="DrawCaptcha();">
<table>
<tr>
    <td>
        Welcome To Captcha<br />
    </td>
</tr>
<tr>
    <td>
        <input type="text" id="txtCaptcha" 
            style="background-image:url('<?php echo base_url('assets/images/') ?>CB.JPG'); text-align:center; border:none;
            font-weight:bold; font-family:Modern; height :160%" />
        <input type="button" id="btnrefresh" value="Refresh" onclick="DrawCaptcha();" />
    </td>
</tr>
<tr>
    <td>
        <input type="text" id="txtInput"/>    
    </td>
</tr>
<tr>
    <td>
        <input id="Button1" type="button" value="Check" onclick="alert(ValidCaptcha());"/>
    </td>
</tr>
</table>
</body>
</html>