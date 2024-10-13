<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
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

        }

        .crumbs {
            opacity: 50%;
            margin: 50px 50px;
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

    <div class="blob-container"></div> <!-- Blob container for background animation -->

    <div class="header">
        <div class="logo">ATTENDIFY</div>
        <div class="crumbs">VERIFIED</div>
    </div>

    <div class="container">


        <div class="container1">

            <p><span class="low-opacity">Hi </span><span class="important">[User's Name]</span></p>
            <p><span class="low-opacity">you're </span><span class="important">good</span><span class="low-opacity"> to
                    go!<br><br> <br><br> 
                    
                    
                    You may now</span><span class="important"> access</span><span class="low-opacity">
                     the app<br><br> <br><br> 
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