<?php
$a=$_POST['inputImage'];
?>
<!DOCTYPE html>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<body background="https://static.vecteezy.com/system/resources/previews/000/530/854/original/low-poly-banner-design-vector.jpg">
<html>
<head>
    <title>辨識結果</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
</head>
<body onload="processImage()">
<script type="text/javascript">
    function processImage() {
        // **********************************************
        // *** Update or verify the following values. ***
        // **********************************************
        let subscriptionKey = '98f07e5fdb234b309ac027a196bb6306';
        let endpoint = 'https://westus2.api.cognitive.microsoft.com/customvision/v3.0/Prediction/a6b26622-5333-491e-85a5-c5575de1b856/classify/iterations/Iteration1/url';
        if (!subscriptionKey) { throw new Error('Set your environment variables for your subscription key and endpoint.'); }
        
        // Display the image.
        var sourceImageUrl = document.getElementById("inputImage").value;
        document.querySelector("#sourceImage").src = sourceImageUrl;
        // Make the REST API call.
        $.ajax({
            url: endpoint + "?",
            // Request headers.
            beforeSend: function(xhrObj){
                xhrObj.setRequestHeader("Content-Type","application/json");
                xhrObj.setRequestHeader("Prediction-Key", subscriptionKey);
            },
            type: "POST",
            // Request body.
            data: '{"url": ' + '"' + sourceImageUrl + '"}',
        })
        .done(function(data) {
            // Show formatted JSON on webpage.
            $("#responseTextArea").val(JSON.stringify(data, null, 2));
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            // Display error message.
            var errorString = (errorThrown === "") ? "Error. " :
                errorThrown + " (" + jqXHR.status + "): ";
            errorString += (jqXHR.responseText === "") ? "" :
                jQuery.parseJSON(jqXHR.responseText).message;
            alert(errorString);
        });
    };
</script>

<input type="hidden" name="inputImage" id="inputImage" value="<?php echo $a;?>" />
<center><div align=center id="wrapper" style="width:1020px; display:table;">
    <div align=center id="jsonOutput" style="width:600px; display:table-cell;">
        <h1 style="
    color: #FF0000;" align=center>辨識結果:</h1>
        <br><br>
        <textarea align=center id="responseTextArea" class="UIInput"
                  style="width:580px; height:388px;"></textarea>
    </div>
    <div align=center id="imageDiv" style="width:420px; display:table-cell;">
        <h1 style="
    color: #FF0000;" align=center>要辨識之圖片:</h1>
        <br><br>
        <img align=center id="sourceImage" width="580" height="393" />
    </div>
</div>
<input style="width:120px;height:40px;font-size:20px;" type="button" value="回上頁" onclick="location.href='index.html'"></center>
</body>
</html>