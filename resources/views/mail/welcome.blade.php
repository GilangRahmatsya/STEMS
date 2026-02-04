<x-mail::message>
# Welcome to STEMS

Hello {{ $user->name }},

Thank you for joining **STEMS** - Swiper Tools & Equipment Management System. We're excited to have you on board!

Your account is now active, and you can start exploring our extensive collection of tools and equipment available for rent.

## What's Next?

1. **Complete Your Profile** - Add your KTP information for identity verification
2. **Browse Items** - Explore our catalog of tools and equipment
3. **Make Your First Rental** - Start renting items today with special introductory rates

## 30 Days Free Trial

You have access to a **30-day free trial** period. This is a great opportunity to explore STEMS without any commitment.

<x-mail::button :url="route('user.dashboard')">
Get Started
</x-mail::button>

If you have any questions or need assistance, don't hesitate to reach out to our support team.

Best regards,<br>
The STEMS Team
</x-mail::message>
