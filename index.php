<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                
        <script src="./node_modules/html5-qrcode/html5-qrcode.min.js"></script>

        <link rel="stylesheet" href="./css/style.css">
    </head>
    <body>
        <div class="container">
            <div class="container">
                <h1 style="text-align: center;">Tickets Scanner - Altromondo Studios</h1>
            </div>
            <div class="container">
                <main>
                    <div id="reader"></div>
                    <div id="result"></div>
                </main>
            </div>
        </div>
        
    </body>
    <script>

        function clearScanner() {
            scanner.clear();
            // Clears scanning instance
            document.getElementById('reader').remove();
            // Removes reader element from DOM since no longer needed
        }

        const scanner = new Html5QrcodeScanner('reader', { 
            // Scanner will be initialized in DOM inside element with id of 'reader'
            qrbox: {
                width: 250,
                height: 250,
            },  // Sets dimensions of scanning box (set relative to reader element width)
            fps: 20, // Frames per second to attempt a scan
        });


        scanner.render(success, error);
        // Starts scanner

        function success(result) {

            clearScanner();

            // 1. Create a new XMLHttpRequest object
            let xhr = new XMLHttpRequest();

            // 2. Configure it: GET-request for the URL /article/.../load
            var body = `action=check_in_barcode&api_key=12326&barcode=${result}`;
            xhr.open('POST', 'https://altromondo.com/wp-admin/admin-ajax.php?_fs_blog_admin=true');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            // 4. This will be called after the response is received
            xhr.onload = function() {
                if(xhr.status == 200) {
                    switch (xhr.responseText) {
                        case '1' :
                            alert('ticket valid!');
                            break;
                        case '2':
                            alert('ticket NOT valid, or already validated');
                            break;
                        default:
                            alert('error: try again');
                            break
                    }
                }
            };

            xhr.onprogress = function(event) {
            if (event.lengthComputable) {
                alert(`Received ${event.loaded} of ${event.total} bytes`);
            } else {
                alert(`Received ${event.loaded} bytes`); // no Content-Length
            }

            };

            xhr.onerror = function() {
                alert("Request failed");
            };
            // 3. Send the request over the network
            xhr.send(body);
        }

        function error(err) {
            console.error(err);
            // Prints any errors to the console
        }

    </script>
</html>

