        // Initialize Three.js
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer();
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.getElementById('background').appendChild(renderer.domElement);

        // Responsive Design
        window.addEventListener('resize', () => {
            renderer.setSize(window.innerWidth, window.innerHeight);
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
        });

        // Load star texture
        const textureLoader = new THREE.TextureLoader();
        const starTexture = textureLoader.load('star.png');

        // Create particle system
        const particlesGeometry = new THREE.BufferGeometry();
        const particlesCount = 1000;
        const posArray = new Float32Array(particlesCount * 2);
        const velocityArray = new Float32Array(particlesCount * 2);

        // Positions and speed
        for (let i = 0; i < particlesCount * 3; i++) {
            posArray[i] = 0; // Start in middle
            velocityArray[i] = (Math.random() - 0.5) * 0.01; // Random directions and speed
        }
        particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
        particlesGeometry.setAttribute('velocity', new THREE.BufferAttribute(velocityArray, 3));

        const particlesMaterial = new THREE.PointsMaterial({
            size: 0.01, // Double start size
            map: starTexture,
            transparent: true
        });

        const particleMesh = new THREE.Points(particlesGeometry, particlesMaterial);
        scene.add(particleMesh);

        // Camera positioning
        camera.position.z = 3;

        // Animation loop
        const animate = () => {
            requestAnimationFrame(animate);

            // Star movement
            const positions = particleMesh.geometry.attributes.position.array;
            const velocities = particleMesh.geometry.attributes.velocity.array;
            for (let i = 0; i < positions.length; i++) {
                positions[i] += velocities[i];

                // Reset star to starting position when reaching screen border
                if(Math.abs(positions[i]) > 5) {
                    positions[i] = 0;
                    velocities[i] = (Math.random() - 0.5) * 0.01;
                }
            }
            particleMesh.geometry.attributes.position.needsUpdate = true;

            // Increase particle size
            particlesMaterial.size += 0.00001;

            renderer.render(scene, camera);
        };

        animate();
    
        // Stepbystep
        const textElement = document.getElementById('text');
        const emailInput = document.getElementById('emailInput');
        const text1 = "Welcome to Your Website!";
        const text2 = "Time to start your journey.";
        const text3 = "Enter your email"
        let index = 0;
        let blinkCount = 0;

    function blinkCursor() {
        if (blinkCount < 8) { // 8, bc there is 2 states per blink (on/off)
            textElement.innerHTML = blinkCount % 2 === 0 ? "|" : "";
            blinkCount++;
            setTimeout(blinkCursor, 500); // Blinking speed
        } else {
            textElement.innerHTML = ""; // Remove cursor befor text appears
            typeWriter(); // Start typewriter effect
        }
    }


        function typeWriter() {
            if (index < text1.length) {
                textElement.innerHTML += text1.charAt(index);
                index++;
                setTimeout(typeWriter, 100); // Typewriter speed for 1st part
            } else if (index === text1.length) {
                textElement.innerHTML += "<br>"; // Adds break
                index++;
                setTimeout(typeWriter, 100);
            } else if (index > text1.length && index < text1.length + text2.length + 1) {
                textElement.innerHTML += text2.charAt(index - text1.length - 1);
                index++;
                setTimeout(typeWriter, 100); // Typewriter speed for 2nd part
            } else if (index === text1.length + text2.length + 1) {
                textElement.innerHTML += "<br><br>"; // Adds double break
                index++;
                setTimeout(typeWriter, 100);
            } else if (index > text1.length + text2.length + 1 && index < text1.length + text2.length + text3.length + 2) {
                textElement.innerHTML += text3.charAt(index - text1.length - text2.length - 2);
                index++;
                setTimeout(typeWriter, 100); // Typewriter speed for 3rd part
            } else {
                // Show email input after sequence
                emailInput.style.display = 'block';
                document.getElementById('submitEmail').style.display = 'block';
            }
        }

         blinkCursor();
        
        // First continue button
document.getElementById('submitEmail').addEventListener('click', function() {
    var email = document.getElementById('emailInput').value;
    if (validateEmail(email)) {
        // AJAX request to check if email is already used
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'registerscript.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE) {
                if (this.status === 409) { // Conflict, email already taken
                    alert(this.responseText); 
                } else if (this.status === 200) {
                    // Email available, show password input
                    document.getElementById('passwordText').style.display = 'block';
                    document.getElementById('passwordInput').style.display = 'block';
                    document.getElementById('submitPassword').style.display = 'block';
                }
            }
        };
        xhr.send('checkEmail=' + encodeURIComponent(email));
    } else {
        alert("Please enter valid email.");
    }
});

// Second continue button
document.getElementById('submitPassword').addEventListener('click', function() {
    if (validatePassword(document.getElementById('passwordInput').value)) {
        // Show username input
        document.getElementById('usernameInput').style.display = 'block';
        document.getElementById('submitUsername').style.display = 'block';
        document.getElementById('usernameText').style.display = 'block';
    } else {
        alert("Password requires small letter, big letter, number and special character.");
    }
});

// Validate
function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function validatePassword(password) {
    var re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(\W|_)).+$/;
    return re.test(password);
}

// Register button
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        e.preventDefault();

        var email = document.getElementById('emailInput').value;
        var password = document.getElementById('passwordInput').value;
        var username = document.getElementById('usernameInput').value;

        var formData = new FormData();
        formData.append('email', email);
        formData.append('password', password);
        formData.append('username', username);

        // AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'registerscript.php', true);
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                // Register success
                alert(this.responseText);
                setTimeout(function() {
                window.location.href = "#"; // Location directed to
            }, 1000);
            } else if (this.readyState === XMLHttpRequest.DONE) {
                // Registration failed
                alert("Registration failed: " + this.responseText);
            }
        };
        xhr.send(formData); // Send
    });