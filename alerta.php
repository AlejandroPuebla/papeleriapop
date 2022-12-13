<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papeleria Pop</title> 

<body>
    <div class="alert alert-danger position-absolute d-inline-flex p-2" role="alert" ></div>
    <div id="number" class="text-danger" style="color:white;"></div>

<script type="text/javascript">
    n=30
    var l= document.getElementById("number");
    var id = window.setInterval(function(){
        document.onmousemove = function(){
            n=30
        };

        l.innerText = n;
        n--;

        if(n<= -1){
            alert("La sesion expiró.");
            location.href="../../login/formulario.html"
        }
    },1200);
</script>
<script>src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"</script>
</body>
</html>