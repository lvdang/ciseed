<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
		<title>CISeed Project</title>
		
		<script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.js"></script>
		<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		
		<style type="text/css">
			body {
			  padding-top: 20px;
			  padding-bottom: 20px;
			}
			.navbar {
			  margin-bottom: 20px;
			}
		</style>
	</head>
	<body>
		<div class="container">
		
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="javascript:void(0)">CISeed Project</a>
					</div>
				</div>
			</nav>
			
			
		</div>
	         
         
        <div class="col-lg-12 col-sm-12">
            <table class="table table-striped table-hover">
                <tbody id="main_body"></tbody>
            </table>
        </div>

	<script>
		(function($) {
			 var module = (function() {
                    var obj = {};
                    obj.main_body = document.getElementById('main_body');

                    obj.getStudents = function(obj) {
                    	var dfd = $.Deferred();
                         $.ajax( { url : "http://localhost/show",
                         	       dataType: 'JSON',
                         	       method : 'GET',
                         	       success : function(json) {
                         	       	   dfd.resolve(json);
                         	       },
                         	       error : function(e) {
                         	       	   dfd.reject(e);
                         	       }
                               });
                         return dfd.promise();
                    };

                    obj.build = function(obj) {
                       var len = obj.length;
                       for (var i = 0; i < len; i++) {
                       	  var tr = document.createElement('tr');
                       	  for (var x in obj[i]) {
                           var td = document.createElement('td');

                           var textNode = document.createTextNode(obj[i][x]);
                           td.appendChild(textNode);
                           tr.appendChild(td);
                          }
                          this.main_body.appendChild(tr);
                       }
                    }

                    return obj;                  
			 })();

			 var promise = module.getStudents();
			 promise.then(function(json) {
			 	module.build(json);
                 console.log(json);
			 }, function(e) {
                 console.log('error', e);
			 });

			 console.log($);

		})($);
	</script>
	
	</body>
</html>
