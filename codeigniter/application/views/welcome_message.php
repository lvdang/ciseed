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
               <thead>
                       <tr>
                            <th>id</th>
                            <th>username</th>
                            <th>password</th>
                        </tr>
                  </thead>
                <tbody id="main_body"></tbody>
            </table>
            
              <button type="button" class="btn btn-info btn-sm" id="shuffle">Shuffle</button>
             
        </div>

	<script>
		(function($) {

       // Module to handle initialization for DOM events, private and public methods for logic. 
			 var module = (function() {
                    var obj = {};
                    var url = "http://localhost/";


                    obj.students = [];
                    obj.main_body = document.getElementById('main_body');
                     
                    var init = function() {
                         buttonEvent();
                    };

                    var buttonEvent = function() {
                        var shuffle = document.getElementById('shuffle');
                        shuffle.addEventListener('click', function(e)  {
                              shuffleInfo();
                              shufflePromise(obj.updateStudents(obj.students));
                        });
                    };

                    var shufflePromise = function(promise) {
                        promise.then(function(json) {
                           console.log('shuffle', json);
                           if (json.success === 4) {
                           	   obj.build(obj.students);
                           } 
                        }, function(e) {
                        	console.log('shuffel error', e);
                        });
                    };

                    var shuffleInfo = function(oj) {
                         var len = obj.students.length;

                         for (var i = 0; i < len; i++) {
                              for (var x in obj.students[i]) {
                              	  obj.students[i].password = generator();
                              	  obj.students[i].user_name = generator();
                              }
                         }
                          
                     };


                     var generator = function(len) {
                       var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!-/=?";
                       var str = "";
                       len = len || 8;
                       var clen = chars.length;
                       for (var i = 0; i < len; i++) {
                       	   var num = Math.floor(Math.random() * clen);
                           str += chars.charAt(num); 
                       }
                      
                       return str;
                     };

                    
                    obj.getStudents = function(oj) {
                    	var dfd = $.Deferred();
                         $.ajax( { url : url + 'show',
                         	       dataType: 'JSON',
                         	       method : 'GET',
                         	       tryCount : 0,
                         	       retryLimit : 3,
                         	       success : function(json) {
                         	       	   dfd.resolve(json);
                         	       },
                         	       error : function(e) {
                                     this.tryCount++;
                                   	 if (this.tryCount <= this.retryLimit) {
                                            $.ajax(this);                                   	 	
                                   	 } else {
                                   	    dfd.reject(e);
                                   	 }
                         	       }
                               });
                         return dfd.promise();
                    };

                    obj.updateStudents = function(oj) {
                         var dfd = $.Deferred();


                         $.ajax( { url : url + 'update', 
                                   dataType: 'JSON',
                                   tryCount : 0,
                                   retryLimit : 3,
                                   method : 'POST',
                                   data : { students : oj },
                                   success : function(json) {
                                     dfd.resolve(json);
                                   }, 
                                   error : function(e) {
                                   	 this.tryCount++;
                                   	 if (this.tryCount <= this.retryLimit) {
                                            $.ajax(this);                                   	 	
                                   	 } else {
                                   	    dfd.reject(e);
                                   	 }
                                   }

                                 });

                         return dfd.promise();
                    };

                    obj.generator = function(len) {
                       var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!-/=?";
                       var str = "";
                       len = len || 8;
                       var clen = chars.length;
                       for (var i = 0; i < len; i++) {
                       	   var num = Math.floor(Math.random() * clen);
                           str += chars.charAt(num); 
                       }
                      
                       return str;

                     };

                 
                    obj.build = function(oj) {
                       var len = oj.length;
                       
                       this.main_body.innerHTML = '';
                       for (var i = 0; i < len; i++) {
                       	  var tr = document.createElement('tr');
                       	  for (var x in oj[i]) {
                           var td = document.createElement('td');
                           var textNode = document.createTextNode(oj[i][x]);
                           td.appendChild(textNode);
                           tr.appendChild(td);
                          }
                          this.main_body.appendChild(tr);
                       }
                    }

                    init();
                    
                    return obj;                  
			 })();

                    

			 module.getStudents().then(function(json) {
                                // save json copy
			   	module.students = json;
                                // build the table
			 	 module.build(json);
			 }, function(e) {
          console.log('error', e);
			 });

			 console.log($);

		})($);
	</script>
	
	</body>
</html>
