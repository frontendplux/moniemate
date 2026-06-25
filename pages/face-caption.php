<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GFL Identity Node - Secure Face Biometric Capture</title>
    
    <!-- Google Fonts (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --gfl-green: #198754;
            --gfl-green-dark: #146c43;
            --gfl-whitesmoke: #f8f9fa;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--gfl-whitesmoke);
        }
        .panel-vh {
            min-height: 100vh;
        }
        .btn-gfl-success {
            background-color: var(--gfl-green);
            border: none;
            transition: all 0.25s ease;
        }
        .btn-gfl-success:hover {
            background-color: var(--gfl-green-dark);
            transform: translateY(-1px);
        }
        .btn-gfl-outline {
            border: 2px solid #ddd;
            color: #666;
            transition: all 0.25s ease;
        }
        .btn-gfl-outline:hover {
            background-color: #fff;
            border-color: #333;
            color: #111;
        }
        /* Camera View Finder Mechanics */
        .camera-container {
            position: relative;
            width: 280px;
            height: 280px;
            margin: 0 auto;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid #dee2e6;
            background-color: #212529;
            box-shadow: inset 0 0 20px rgba(0,0,0,0.6);
        }
        .camera-container.active-stream {
            border-color: var(--gfl-green);
        }
        #videoStream, #capturedImageCanvas {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: scaleX(-1); /* Mirror view for natural interaction */
        }
        /* Biometric Guidance Oval Overlay Overlay */
        .biometric-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 70%;
            height: 80%;
            border: 2px dashed rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            pointer-events: none;
            box-shadow: 0 0 0 9999px rgba(0, 0, 0, 0.4); /* Dim out edge properties */
            transition: border-color 0.3s ease;
        }
        .camera-container.active-stream .biometric-overlay {
            border-color: var(--gfl-green);
            box-shadow: 0 0 0 9999px rgba(25, 135, 84, 0.15);
        }
    </style>
</head>
<body class="bg-light">

    <div class="container py-4">
        <div class="row justify-content-center align-items-center panel-vh">
            <div class="col-12 col-md-9 col-lg-6" data-reveal="fade-up">
                
                <!-- Main Container Card -->
                <div class="bg-white p-4 p-sm-5 rounded-5 shadow-sm border border-light-subtle text-center">
                    
                    <!-- Top Navigation Progress Indicator -->
                    <div class="d-flex justify-content-between align-items-center mb-4 text-start">
                        <div class="d-flex align-items-center">
                            <span class="bg-success rounded-3 d-flex align-items-center justify-content-center me-2 text-white" style="width: 32px; height: 32px;">
                                <i class="bi bi-camera-video-fill fs-6"></i>
                            </span>
                            <span class="fw-bold text-dark fs-6">Biometric Node</span>
                        </div>
                        <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1.5 small fw-semibold">Security Phase</span>
                    </div>

                    <!-- Header Content -->
                    <div class="mb-4">
                        <h2 class="fw-bold text-dark mb-2">Face Verification</h2>
                        <p class="text-secondary small max-width-sm mx-auto" style="max-width: 400px;">
                            Position your face inside the tracking oval. This biometric layer protects your wallets against credential cloning attempts.
                        </p>
                    </div>

                    <!-- Interactive Camera Live Block Viewfinder -->
                    <div class="my-4 position-relative">
                        <div id="cameraFrame" class="camera-container">
                            <!-- Live feed video output string element -->
                            <video id="videoStream" autoplay playsinline></video>
                            <!-- Static fallback vector image when camera is offline -->
                            <div id="cameraPlaceholder" class="position-absolute top-50 left-50 translate-middle text-white text-opacity-50">
                                <i class="bi bi-person-bounding-box" style="font-size: 4rem;"></i>
                                <span class="d-block small mt-2">Camera Access Pending</span>
                            </div>
                            <!-- Face Alignment Overlay Matrix -->
                            <div class="biometric-overlay"></div>
                        </div>

                        <!-- System Notification Alerts Message Box -->
                        <div id="streamStatusMessage" class="small text-muted mt-3 font-monospace">
                            <i class="bi bi-info-circle me-1"></i> Grant camera permission when prompted.
                        </div>
                    </div>

                    <!-- Primary Execution Functional Buttons Interface -->
                    <div class="vstack gap-2.5 max-width-md mx-auto mt-4" style="max-width: 400px;">
                        
                        <!-- Main Trigger Action: Initialize / Capture photo -->
                        <button type="button" id="captureActionButton" class="btn btn-success btn-lg w-100 rounded-pill py-3 fw-medium text-white shadow-sm d-flex align-items-center justify-content-center gap-2 btn-gfl-success">
                            <i class="bi bi-camera-fill"></i> Activate System Camera
                        </button>

                        <!-- Alternative Secondary Option: Manual File upload utility path -->
                        <label for="manualFileInput" class="btn btn-light border btn-lg w-100 rounded-pill py-2.5 fs-6 fw-medium text-secondary d-flex align-items-center justify-content-center gap-2 m-0 cursor-pointer">
                            <i class="bi bi-upload"></i> Upload Valid Passport Instead
                        </label>
                        <input type="file" id="manualFileInput" accept="image/*" class="d-none">

                        <!-- Business Rule Check: Bypass biometric validation string -->
                        <button type="button" id="skipBiometricsButton" class="btn btn-gfl-outline btn-lg w-100 rounded-pill py-3 fw-medium mt-2 d-flex align-items-center justify-content-center gap-2">
                            Skip Biometrics, Use Manual Verification <i class="bi bi-arrow-right-short fs-4"></i>
                        </button>
                    </div>

                    <!-- Legal & Privacy Infrastructure Assurance Statement -->
                    <p class="text-secondary small mt-4 mb-0 pt-3 border-top border-light-subtle" style="font-size: 0.72rem; line-height: 1.4;">
                        <i class="bi bi-shield-fill-check text-success"></i> GFL Biometric Privacy Standard: Profile metrics match securely with centralized encryption string blocks. Your asset coordinates remain private.
                    </p>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ScrollReveal CDN Library -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- Custom Micro-Front-End Interaction Stream Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            
            const video = document.getElementById("videoStream");
            const cameraFrame = document.getElementById("cameraFrame");
            const placeholder = document.getElementById("cameraPlaceholder");
            const captureBtn = document.getElementById("captureActionButton");
            const statusMsg = document.getElementById("streamStatusMessage");
            const skipBtn = document.getElementById("skipBiometricsButton");
            const manualFile = document.getElementById("manualFileInput");

            let localStream = null;
            let isCameraActive = false;

            // 1. Camera Initialization Stream Sequence
            async function startCameraSystem() {
                try {
                    statusMsg.innerHTML = `<span class="text-warning"><i class="spinner-border spinner-border-sm me-1"></i> Requesting platform media hardware loops...</span>`;
                    
                    localStream = await navigator.mediaDevices.getUserMedia({ 
                        video: { facingMode: "user", width: 400, height: 400 }, 
                        audio: false 
                    });
                    
                    video.srcObject = localStream;
                    cameraFrame.classList.add("active-stream");
                    placeholder.classList.add("d-none");
                    
                    // Mutate primary activation button to capture state
                    captureBtn.innerHTML = `<i class="bi bi-person-badge-fill"></i> Snapshot Facial Balance`;
                    captureBtn.classList.replace("btn-success", "btn-primary");
                    statusMsg.innerHTML = `<span class="text-success"><i class="bi bi-circle-fill animate-pulse me-1"></i> Live Stream Link Connected. Blink slowly.</span>`;
                    isCameraActive = true;
                } catch (err) {
                    console.error("Camera node hardware link failure: ", err);
                    statusMsg.innerHTML = `<span class="text-danger"><i class="bi bi-exclamation-triangle-fill me-1"></i> Hardware lock: Access denied or camera unavailable.</span>`;
                }
            }

            // 2. Action Button Router Controller Execution Loop
            captureBtn.addEventListener("click", function() {
                if (!isCameraActive) {
                    startCameraSystem();
                } else {
                    // Simulating Biometric Scan Matching Sequence
                    statusMsg.innerHTML = `<span class="text-success"><i class="spinner-border spinner-border-sm me-1"></i> Processing cloud matching vector algorithms...</span>`;
                    captureBtn.disabled = true;
                    
                    setTimeout(() => {
                        alert("Biometric vector parsing checks complete! Secure identity configuration node linked successfully.");
                        // Stop video hardware stream traces gracefully
                        if (localStream) {
                            localStream.getTracks().forEach(track => track.stop());
                        }
                        window.location.href = "#"; // Dashboard path location endpoint target
                    }, 1800);
                }
            });

            // 3. Manual Document File Upload Target Listener
            manualFile.addEventListener("change", function() {
                if(this.files && this.files[0]) {
                    statusMsg.innerHTML = `<span class="text-success"><i class="bi bi-file-earmark-image-fill me-1"></i> Loaded: ${this.files[0].name} (Pending submission validations)</span>`;
                    captureBtn.innerHTML = `<i class="bi bi-cloud-arrow-up-fill"></i> Validate Uploaded Identity`;
                    captureBtn.classList.replace("btn-primary", "btn-success");
                    isCameraActive = false; // Reset camera loops
                }
            });

            // 4. Skip Biometrics Action Logic Routing Matrix
            if (skipBtn) {
                skipBtn.addEventListener("click", function () {
                    const confirmSkip = confirm("Are you sure you want to skip facial capture? Profiling without real-time biometrics places your account structure into a standard manual verification state, slowing down loan limits and verification approvals.");
                    if (confirmSkip) {
                        if (localStream) {
                            localStream.getTracks().forEach(track => track.stop());
                        }
                        alert("Bypassing biometrics validation string. Initializing manual dashboard constraints tier.");
                        window.location.href = "#"; // Replace with your standard basic setup route endpoint
                    }
                });
            }

            // 5. ScrollReveal Animations Layout Initialization
            if (typeof ScrollReveal !== 'undefined') {
                ScrollReveal().reveal('[data-reveal="fade-up"]', {
                    origin: 'bottom',
                    distance: '30px',
                    duration: 900,
                    easing: 'cubic-bezier(0.4, 0, 0.2, 1)'
                });
            }
        });
    </script>
</body>
</html>