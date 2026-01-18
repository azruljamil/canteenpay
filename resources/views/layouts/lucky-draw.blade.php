<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lucky Draw</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('img/10083.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 15px;
        }
        .title {
            font-size: 48px;
            font-weight: bold;
            color: #1E4385;
            text-shadow: 3px 3px 0px #e0e0e0;
        }
        .winner-box {
            margin: 20px auto;
            padding: 40px;
            width: 400px;
            height: 100px;
            font-size: 32px;
            font-weight: bold;
            background: linear-gradient(white, #e0e0e0);
            border-radius: 15px;
            border: 8px solid #1E4385;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
            position: relative;
        }
        .winner-box::before {
            content: "";
            position: absolute;
            top: -12px;
            left: -12px;
            right: -12px;
            bottom: -12px;
            border: 6px dotted gold;
            border-radius: 20px;
        }
        .draw-btn {
            background: #1E4385;
            border: none;
            padding: 15px 40px;
            font-size: 24px;
            font-weight: bold;
            color: white;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 5px 5px 0px #e0e0e0;
        }
        .draw-btn:hover {
            background: #e0e0e0;
        }
    </style>
</head>
<body>
@yield('content')

<script src="{{ url('js/tsparticles.confetti.bundle.min.js') }}"></script>    
    <script>
        let names = "";
        fetch('/list-draw')
        .then(response => response.json())
        .then(data => {
            names = data.map(item => item.name);
        })
        .catch(error => console.error('Error fetching names:', error));

        let interval;

        document.getElementById("draw-btn").addEventListener("click", function() {
            document.getElementById("draw-btn").innerText = "Drawing...";
            let spinner = document.getElementById("winner");
            let startTime = Date.now();

            interval = setInterval(() => {
                let randomIndex = Math.floor(Math.random() * names.length);
                spinner.innerHTML = names[randomIndex];

                if (Date.now() - startTime >= 50000) { // Stop after 50 seconds
                    clearInterval(interval);
                    let winner = names[randomIndex];
                    const end = Date.now() + 15 * 1000;

                    const duration = 15 * 1000,
                    animationEnd = Date.now() + duration,
                    defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

                    function randomInRange(min, max) {
                    return Math.random() * (max - min) + min;
                    }

                    const interval2 = setInterval(function() {
                    const timeLeft = animationEnd - Date.now();

                    if (timeLeft <= 0) {
                        return clearInterval(interval2);
                    }

                    const particleCount = 50 * (timeLeft / duration);

                    // since particles fall down, start a bit higher than random
                    confetti(
                        Object.assign({}, defaults, {
                        particleCount,
                        origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 },
                        })
                    );
                    confetti(
                        Object.assign({}, defaults, {
                        particleCount,
                        origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 },
                        })
                    );
                    }, 250);
                    document.getElementById("draw-btn").innerText = "Here's your winner!";
                    //alert("🎉 The winner is: " + winner + " 🎉");
                }
            }, 70); // Change names every 70ms
        });

    </script>

</body>
</html>
