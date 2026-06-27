<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GFL Security - Create Transaction PIN</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root { --gfl-green: #198754; }
        body { background-color: #f8f9fa; font-family: 'Poppins', sans-serif; }
        .pin-input-field {
            width: 60px;
            height: 70px;
            font-size: 1.8rem;
            text-align: center;
            border: 2px solid #dee2e6;
            border-radius: 14px;
            font-weight: 700;
        }
        .pin-input-field:focus { border-color: var(--gfl-green); outline: none; }
        .btn-gfl { background-color: var(--gfl-green); color: white; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-5 text-center">
            
            <div class="bg-white p-5 rounded-5 shadow-sm">
                <i class="bi bi-shield-lock-fill fs-1 text-success mb-3 d-block"></i>
                <h4 class="fw-bold">Set Transaction PIN</h4>
                <p class="text-secondary small mb-4">Create a 4-digit code to authorize all secure platform operations.</p>

                <form id="pinForm">
                    <!-- PIN Matrix -->
                    <div class="d-flex justify-content-center gap-3 mb-4" id="pinContainer">
                        <input type="password" class="pin-input-field" maxlength="1" inputmode="numeric" required>
                        <input type="password" class="pin-input-field" maxlength="1" inputmode="numeric" required>
                        <input type="password" class="pin-input-field" maxlength="1" inputmode="numeric" required>
                        <input type="password" class="pin-input-field" maxlength="1" inputmode="numeric" required>
                    </div>

                    <div class="form-check d-flex justify-content-center mb-4">
                        <input class="form-check-input me-2" type="checkbox" id="showPin">
                        <label class="form-check-label text-secondary small" for="showPin">Show PIN characters</label>
                    </div>

                    <button type="submit" class="btn btn-gfl btn-lg w-100 rounded-pill py-3 fw-bold">Save Secure PIN</button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    const inputs = document.querySelectorAll('.pin-input-field');
    const showPin = document.getElementById('showPin');

    // Auto-focus mechanics
    inputs.forEach((input, index) => {
        input.addEventListener('input', (e) => {
            if (e.target.value.length === 1 && index < 3) inputs[index + 1].focus();
        });
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !input.value && index > 0) inputs[index - 1].focus();
        });
    });

    // Toggle masking
    showPin.addEventListener('change', () => {
        const type = showPin.checked ? 'text' : 'password';
        inputs.forEach(input => input.type = type);
    });

    document.getElementById('pinForm').addEventListener('submit', (e) => {
        e.preventDefault();
        alert('PIN Configuration Saved Successfully.');
    });
</script>

</body>
</html>