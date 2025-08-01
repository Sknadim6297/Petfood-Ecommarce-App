<div>
    <h2 class="section-title">
        <i class="fas fa-user-edit"></i> Profile Information
    </h2>
    <p class="section-subtitle">Update your account's profile information and email address.</p>

    @if (session('status') === 'profile-updated')
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> Profile updated successfully!
        </div>
    @endif

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="name" class="form-label">
                <i class="fas fa-user"></i> Full Name
            </label>
            <input 
                id="name" 
                name="name" 
                type="text" 
                class="form-control" 
                value="{{ old('name', $user->name) }}" 
                required 
                autofocus 
                autocomplete="name"
                placeholder="Enter your full name"
            />
            @if($errors->get('name'))
                @foreach($errors->get('name') as $error)
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle"></i> {{ $error }}
                    </div>
                @endforeach
            @endif
        </div>

        <div class="form-group">
            <label for="email" class="form-label">
                <i class="fas fa-envelope"></i> Email Address
            </label>
            <input 
                id="email" 
                name="email" 
                type="email" 
                class="form-control" 
                value="{{ old('email', $user->email) }}" 
                required 
                autocomplete="username"
                placeholder="Enter your email address"
            />
            @if($errors->get('email'))
                @foreach($errors->get('email') as $error)
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle"></i> {{ $error }}
                    </div>
                @endforeach
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="verification-notice">
                    <p>
                        <i class="fas fa-exclamation-triangle"></i>
                        Your email address is unverified.
                        <button 
                            form="send-verification" 
                            class="verification-link"
                            type="submit"
                        >
                            Click here to re-send the verification email.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p style="margin-top: 10px; color: #28a745; font-weight: 600;">
                            <i class="fas fa-check"></i>
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> Save Changes
            </button>

            @if (session('status') === 'profile-updated')
                <span class="success-indicator">
                    <i class="fas fa-check"></i> Saved
                </span>
            @endif
        </div>
    </form>
</div>
