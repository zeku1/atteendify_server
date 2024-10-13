<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;700&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Hanken Grotesk', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow-x: hidden;
            position: relative;
            background-color: white;
            color: black;
        }

        .blob-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .blob {
            position: absolute;
            width: 300px;
            height: 300px;
            background-color: #fff;
            border-radius: 50%;
            filter: blur(100px);
            z-index: -1;
            opacity: 0.6;
        }

        .header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 20px;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1;
        }

        p {
            font-size: 20px;
        }

        .container {
            text-align: center;
            padding: 60px 20px;
            margin-top: 60px;
            z-index: 1;
        }

        .important {
            opacity: 1;
        }

        .low-opacity {
            opacity: 0.5;
        }

        a {
            text-decoration: none;
            color: black;
          
            opacity: 1;
            font-size: 20px;
        
            position: relative;
            animation: glow 2s infinite alternate ease-in-out;
      +
        }

        @keyframes glow {
            0% {
                text-shadow: 0 0 5px rgba(0, 0, 0, 0.5), 0 0 10px rgba(0, 0, 0, 0.3);
            }

            50% {
                text-shadow: 0 0 10px rgba(255, 255, 255, 0.6), 0 0 20px rgba(255, 255, 255, 0.4);
            }

            100% {
                text-shadow: 0 0 5px rgba(0, 0, 0, 0.5), 0 0 10px rgba(0, 0, 0, 0.3);
            }
        }



        .footer {
            opacity: 1;
        }


        @media (max-width: 768px) {
            .crumbs {
                margin: 30px 10px;
            }

            .logo {
                margin: 30px 10px;
            }
        }
    </style>
</head>

<body>

    <div class="blob-container"></div>

    <div class="header">
        <div class="logo">ATTENDIFY</div>
        <div class="crumbs">VERIFICATION</div>
    </div>

    <div class="container">
        <div class="container1">
            <p><span class="low-opacity">Hi </span><span class="important">[User's Name]</span></p>
            <p><span class="low-opacity">We're </span><span class="important">happy</span><span class="low-opacity"> to
                    have you here!<br><br> To </span><span class="important">complete</span><span class="low-opacity">
                    your registration, <br>please verify your </span><span class="important">email address</span><span
                    class="low-opacity"><br> by </span><span class="important"> following the task</span><span
                    class="low-opacity"> below:</span></p>
            <br><br>
            <p class="highlight" style="text-align: center;">
                <a href="[verification_link]" class="black"><span class="low-opacity">Tap</span> <span
                        class="important">here</span> to verify <span class="low-opacity">email</span></a>
            </p>

            <br><br>
            <p><span class="low-opacity">If you </span><span class="important">did not</span><span class="low-opacity">
                    sign up for this account,<br> please </span><span class="important">ignore</span><span
                    class="low-opacity"> this email.</span></p>
            <br><br>
            <p class="footer"><span class="low-opacity">Best regards,</span><br><span class="important">The TEAM</span>
            </p>
        </div>
    </div>

    <script>
        const rnd = (min, max) => Math.floor(Math.random() * (max - min + 1) + min);
        const colors = ["#0DFDD9", "#FF5C5C", "#CD75FF"];

        const rndBorderRadius = () =>
            [...Array(4).keys()].map(() => rnd(30, 85) + "%").join(" ") +
            " / " +
            [...Array(4).keys()].map(() => rnd(30, 85) + "%").join(" ");

        const createBlob = ({ id, x, y, color }) => {
            const blobContainer = document.querySelector(".blob-container");
            const blob = document.createElement("div");
            blob.id = `blob-${id}`;
            blob.classList.add("blob");
            blob.style.top = `${y}%`;
            blob.style.left = `${x}%`;
            blob.style.backgroundColor = color;
            blob.style.transform = `scale(${rnd(1.25, 2)})`;
            blob.style.borderRadius = rndBorderRadius();
            blobContainer.appendChild(blob);
            animateBlob(blob);
        };

        const animateBlob = (blob) => {
            const animationDuration = rnd(500, 1000);
            blob.animate(
                [
                    {
                        transform: blob.style.transform,
                        borderRadius: blob.style.borderRadius,
                    },
                    {
                        transform: `scale(${rnd(1.25, 2)})`,
                        borderRadius: rndBorderRadius(),
                    },
                ],
                {
                    duration: animationDuration,
                    direction: "alternate",
                    fill: "both",
                    iterations: Infinity,
                    easing: "ease-in-out",
                }
            );
        };

        [...Array(7).keys()].forEach((blob) => {
            createBlob({
                id: blob,
                x: rnd(-10, 100),
                y: rnd(-10, 100),
                color: colors[rnd(0, colors.length - 1)],
            });
        });
    </script>
</body>

</html>