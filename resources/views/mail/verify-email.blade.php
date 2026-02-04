<x-mail::message>
# Verify Your Email Address

Hello {{ $user->name }},

Thank you for creating a STEMS account. To get started, please verify your email address by clicking the button below.

<x-mail::button :url="route('verification.verify', ['id' => $user->id, 'hash' => $hash])">
Verify Email Address
</x-mail::button>

This verification link will expire in 24 hours.

If you didn't create a STEMS account, you can safely ignore this email.

---

**STEMS** - Swiper Tools & Equipment Management System

Best regards,<br>
The STEMS Team
</x-mail::message>
