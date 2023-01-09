<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
                
        <script src="./node_modules/html5-qrcode/html5-qrcode.min.js"></script>
        <style>
        main {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #reader {
            width: 600px;
        }
        #result {
            text-align: center;
            font-size: 1.5rem;
        }
    </style>
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

            document.getElementById('result').innerHTML = `
            <h2>Success!</h2>
            <p><a href="${result}">${result}</a></p>
            `;
            // Prints result as a link inside result element

            scanner.clear();
            // Clears scanning instance

            document.getElementById('reader').remove();
            // Removes reader element from DOM since no longer needed
        
        }

        function error(err) {
            console.error(err);
            // Prints any errors to the console
        }

    </script>
</html>

