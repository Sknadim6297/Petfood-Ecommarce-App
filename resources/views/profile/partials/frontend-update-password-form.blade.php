<div>
    <h2 class="section-title">
        <i class="fas fa-shield-alt"></i> Update Password
    </h2>
    <p class="section-subtitle">Ensure your account is using a long, random password to stay secure.</p>

    @if (session('status') === 'password-updated')
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> Password updated successfully!
        </div>
    @endif

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="update_password_current_password" class="form-label">
                <i class="fas fa-lock"></i> Current Password
            </label>
            <input 
                id="update_password_current_password" 
                name="current_password" 
                type="password" 
                class="form-control" 
                autocomplete="current-password"
                placeholder="Enter your current password"
            />
            @if($errors->updatePassword->get('current_password'))
                @foreach($errors->updatePassword->get('current_password') as $error)
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle"></i> {{ $error }}
                    </div>
                @endforeach
            @endif
        </div>

        <div class="form-group">
            <label for="update_password_password" class="form-label">
                <i class="fas fa-key"></i> New Password
            </label>
            <input 
                id="update_password_password" 
                name="password" 
                type="password" 
                class="form-control" 
                autocomplete="new-password"
                placeholder="Enter your new password (min. 8 characters)"
            />
            @if($errors->updatePassword->get('password'))
                @foreach($errors->updatePassword->get('password') as $error)
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle"></i> {{ $error }}
                    </div>
                @endforeach
            @endif
        </div>

        <div class="form-group">
            <label for="update_password_password_confirmation" class="form-label">
                <i class="fas fa-check-circle"></i> Confirm Password
            </label>
            <input 
                id="update_password_password_confirmation" 
                name="password_confirmation" 
                type="password" 
                class="form-control" 
                autocomplete="new-password"
                placeholder="Confirm your new password"
            />
            @if($errors->updatePassword->get('password_confirmation'))
                @foreach($errors->updatePassword->get('password_confirmation') as $error)
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle"></i> {{ $error }}
                    </div>
                @endforeach
            @endif
        </div>

        <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> Update Password
            </button>

            @if (session('status') === 'password-updated')
                <span class="success-indicator">
                    <i class="fas fa-check"></i> Saved
                </span>
            @endif
        </div>
    </form>
</div>
