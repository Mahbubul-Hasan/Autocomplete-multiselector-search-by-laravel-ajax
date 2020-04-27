<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Autocomplete Multiselector Search</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
    
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
        
        .full-height {
            height: 100vh;
        }
        
        .flex-center {
            display: flex;
            justify-content: center;
        }
        
        .position-ref {
            position: relative;
        }
        .content {
            text-align: center;
        }
        
        .title {
            font-size: 84px;
        }
        
        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="flex-center position-ref full-height">
        
        <div class="content">
            <div class="title m-b-md">
                Autocomplete Multiselector Search
            </div>
            
            <form id="searchNameByCountry" action="{{ url('/peoples') }}" method="POST">
                <div class="input-group mb-3">
                    @csrf
                    <input type="text" id="country" class="form-control" name="country" placeholder="Search Country" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <input class="btn btn-outline-secondary" type="submit" value="Search"/>
                    </div>
                </div>
            </form>
            <div id="error" style="color: red"></div>
            <div id="demo"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.min.js"></script>
    <script>
        $( function() {
            $('#country').tokenfield({
                autocomplete: {
                    source: "http://127.0.0.1:8000/countryList",
                    delay: 100
                },
                showAutocompleteOnFocus: true
            });
            
            $(document).on("submit", "#searchNameByCountry", function(event){
                event.preventDefault();
                $("#demo").text(""); 
                if ($("#country").val().length > 0) {
                    $("#error").text("");
                    
                    let url = $(this).attr("action");
                    let data = $(this).serialize();
                    
                    $.ajax({
                        url: url, 
                        method: "post", 
                        data: data,
                        dataType: "JSON",
                        success: function(response){
                            if (!response.length ) {
                                console.log("responase", response)
                                $("#demo").html('<p style="color: red">Not Found</p>'); 
                            }
                            response.forEach(fetchData);
                            function fetchData(item, index) {
                                document.getElementById("demo").innerHTML += index+1 + ": " + item.name + "<br>"; 
                            };
                        } 
                    })
                }
                else
                {
                    $("#error").text("Please Enter data") 
                }
            })
        } );
    </script>
</body>
</html>
