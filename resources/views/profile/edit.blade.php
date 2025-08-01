@extends('frontend.layouts.layout')

@section('title', 'Profile Settings - PetNet')

@section('styles')
<style>
/* Profile Page Custom Styles */
.profile-main-section {
    padding: 200px 0 100px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: calc(100vh - 200px);
    margin-top: 30px;
    position: relative;
    z-index: 1;
}

.profile-wrapper {
    max-width: 1000px;
    margin: 0 auto;
}

.profile-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 20px;
}

.profile-header {
    background: linear-gradient(135deg, #fe5716 0%, #ff8a50 100%);
    color: white;
    padding: 40px 30px;
    text-align: center;
    position: relative;
}

.profile-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 20"><defs><radialGradient id="a" cx="50%" cy="0%" r="100%"><stop offset="0%" stop-color="white" stop-opacity="0.1"/><stop offset="100%" stop-color="white" stop-opacity="0"/></radialGradient></defs><rect width="100" height="20" fill="url(%23a)"/></svg>');
    opacity: 0.3;
}

.profile-header h1 {
    margin: 0;
    font-size: 2.2rem;
    font-weight: 700;
    position: relative;
    z-index: 1;
}

.profile-header p {
    margin: 10px 0 0 0;
    opacity: 0.95;
    font-size: 1rem;
    position: relative;
    z-index: 1;
}

.profile-nav {
    background: #fff;
    padding: 0;
    border-bottom: 1px solid #eee;
}

.profile-nav-pills {
    display: flex;
    margin: 0;
    padding: 0;
    list-style: none;
    border-radius: 0;
}

.profile-nav-link {
    flex: 1;
    text-align: center;
    padding: 20px 15px;
    text-decoration: none;
    color: #6c757d;
    font-weight: 600;
    font-size: 0.95rem;
    border-right: 1px solid #eee;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.profile-nav-link:last-child {
    border-right: none;
}

.profile-nav-link:hover {
    color: #fe5716;
    background: #f8f9fa;
    text-decoration: none;
}

.profile-nav-link.active {
    background: #fe5716;
    color: white;
    position: relative;
}

.profile-nav-link.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 0;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    border-bottom: 10px solid #fff;
}

.profile-content {
    padding: 40px;
}

.section-title {
    color: #2c3e50;
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.section-subtitle {
    color: #6c757d;
    margin-bottom: 30px;
    font-size: 0.95rem;
    line-height: 1.5;
}

.form-group {
    margin-bottom: 25px;
}

.form-label {
    display: block;
    color: #495057;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-control {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background-color: #fff;
    font-family: inherit;
}

.form-control:focus {
    outline: none;
    border-color: #fe5716;
    box-shadow: 0 0 0 3px rgba(254, 87, 22, 0.1);
}

.btn-primary {
    background: linear-gradient(135deg, #fe5716 0%, #ff8a50 100%);
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(254, 87, 22, 0.3);
    color: white;
    text-decoration: none;
}

.btn-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
}

.btn-danger:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
}

.btn-secondary {
    background: #6c757d;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-1px);
}

.alert {
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    border: none;
    display: flex;
    align-items: center;
    gap: 10px;
}

.alert-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.error-message {
    color: #dc3545;
    font-size: 0.8rem;
    margin-top: 5px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.verification-notice {
    background: #fff3cd;
    color: #856404;
    padding: 15px;
    border-radius: 8px;
    margin-top: 15px;
    border-left: 4px solid #ffc107;
}

.verification-link {
    color: #fe5716;
    text-decoration: underline;
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
    font-size: inherit;
}

.verification-link:hover {
    color: #e04d0d;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

.success-indicator {
    color: #28a745;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 5px;
}

/* Modal Styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    z-index: 1050;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.modal-content {
    background: white;
    border-radius: 12px;
    padding: 30px;
    max-width: 500px;
    width: 100%;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    position: relative;
}

.modal-header {
    color: #dc3545;
    margin-bottom: 20px;
    font-size: 1.3rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
}

.modal-body {
    color: #6c757d;
    margin-bottom: 25px;
    line-height: 1.6;
}

.modal-footer {
    display: flex;
    gap: 15px;
    justify-content: flex-end;
    margin-top: 25px;
}

@media (max-width: 768px) {
    .profile-main-section {
        padding: 150px 0 80px 0;
        margin-top: 20px;
    }
    
    .profile-nav-pills {
        flex-direction: column;
    }
    
    .profile-nav-link {
        border-right: none;
        border-bottom: 1px solid #eee;
    }
    
    .profile-nav-link:last-child {
        border-bottom: none;
    }
    
    .profile-content {
        padding: 25px 20px;
    }
    
    .modal-content {
        margin: 10px;
        padding: 20px;
    }
}

@media (min-width: 1200px) {
    .profile-main-section {
        padding: 220px 0 120px 0;
    }
    
    .profile-wrapper {
        max-width: 1200px;
    }
}
</style>
@endsection

@section('content')
<div class="profile-main-section">
    <div class="container">
        <div class="profile-wrapper">
            <!-- Profile Header -->
            <div class="profile-card">
                <div class="profile-header">
                    <h1><i class="fas fa-user-circle"></i> Profile Settings</h1>
                    <p>Manage your account information and security preferences</p>
                </div>

                <!-- Navigation -->
                <div class="profile-nav">
                    <div class="profile-nav-pills">
                        <a href="#profile-info" class="profile-nav-link active" onclick="showTab('profile-info', this)">
                            <i class="fas fa-user"></i> Profile Information
                        </a>
                        <a href="#password" class="profile-nav-link" onclick="showTab('password', this)">
                            <i class="fas fa-lock"></i> Password
                        </a>
                        <a href="#delete-account" class="profile-nav-link" onclick="showTab('delete-account', this)">
                            <i class="fas fa-trash-alt"></i> Delete Account
                        </a>
                    </div>
                </div>

                <!-- Content -->
                <div class="profile-content">
                    <!-- Profile Information Tab -->
                    <div id="profile-info" class="tab-content active">
                        @include('profile.partials.frontend-update-profile-information-form')
                    </div>

                    <!-- Password Tab -->
                    <div id="password" class="tab-content">
                        @include('profile.partials.frontend-update-password-form')
                    </div>

                    <!-- Delete Account Tab -->
                    <div id="delete-account" class="tab-content">
                        @include('profile.partials.frontend-delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showTab(tabId, element) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
    });
    
    // Remove active class from all nav links
    document.querySelectorAll('.profile-nav-link').forEach(link => {
        link.classList.remove('active');
    });
    
    // Show selected tab and mark nav link as active
    document.getElementById(tabId).classList.add('active');
    element.classList.add('active');
}
</script>
@endsection
