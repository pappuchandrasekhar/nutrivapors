<html>
<head>

<title></title>

<script>

function formatNumber(num)
{    
    var n = num.toString();
    var nums = n.split('.');
    var newNum = "";
    if (nums.length > 1)
    {
        var dec = nums[1].substring(0,2);
        newNum = nums[0] + "." + dec;
    }
    else
    {
    newNum = num;
    }
    alert(newNum)
}

</script>
</head>

<body>

<a href="#" onclick="formatNumber(1000.45344344)"> Test 1 </a>
<br>

<a href="#" onclick="formatNumber(1000)"> Test 2 </a>
<br>

</br>

</body>
</html>  