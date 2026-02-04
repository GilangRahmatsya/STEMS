<x-mail::message>
# Reset Your Password

Hello {{ $user->name }},

You received this email because you requested a password reset for your STEMS account.

<x-mail::button :url="route('password.reset', $token)">
Reset Password
</x-mail::button>

This password reset link will expire in 60 minutes.

If you didn't request a password reset, you can safely ignore this email.

---

**STEMS** - Swiper Tools & Equipment Management System

Best regards,<br>
The STEMS Team
</x-mail::message>
