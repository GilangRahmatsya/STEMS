# Responsive Design System - Visual Layout Guide

## Screen Size Visualization

```
MOBILE PHONES (< 640px)
╔════════════════════════════════╗
║  [≡] App Name              [⚙] ║  Header
╠════════════════════════════════╣
║                                ║
║  [────────────────────────────] ║
║       Stat Card (Full Width)   ║
║                                ║
║  [────────────────────────────] ║
║       Stat Card (Full Width)   ║
║                                ║
║  [────────────────────────────] ║
║       Stat Card (Full Width)   ║
║                                ║
║  [────────────────────────────] ║
║       Stat Card (Full Width)   ║
║                                ║
║         [Form Button]          ║
║                                ║
╚════════════════════════════════╝

Layout: Single Column (1-column grid)
Spacing: Tight (12px gaps, 16px padding)
Text: Readable 14px minimum
Buttons: Full width, 44px+ height
```

```
TABLETS (640px - 1024px)
╔══════════════════════════════════════════════════╗
║  [≡] App Name                              [⚙]  ║  Header
╠══════════════════════════════════════════════════╣
║                                                  ║
║ [──────────────────] [──────────────────]       ║
║   Stat Card #1        Stat Card #2              ║
║                                                  ║
║ [──────────────────] [──────────────────]       ║
║   Stat Card #3        Stat Card #4              ║
║                                                  ║
║ [──────────────────────────────────────────]   ║
║              Form with 2 columns                ║
║                                                  ║
║ [────────────────────][────────────────────]   ║
║   Recent Rentals       Most Popular Items       ║
║                                                  ║
╚══════════════════════════════════════════════════╝

Layout: 2-column grid (at sm: breakpoint)
Spacing: Moderate (16px gaps, 24px padding)
Text: Larger 16px body text
Buttons: Proportional sizing
```

```
DESKTOPS (1024px+)
╔═════════════════════════════════════════════════════════════════════════════════╗
║  [≡] App Name                                                        Profile [⚙] ║
╠═════════════════════════════════════════════════════════════════════════════════╣
║ [Sidebar]                                                                       ║
║ • Dashboard                                                                     ║
║ • Items          ┌───────────────┬───────────────┬───────────────┬──────────┐  ║
║ • Rentals        │ Stat #1       │ Stat #2       │ Stat #3       │ Stat #4  │  ║
║ • Financial      │ (24px + icon) │ (24px + icon) │ (24px + icon) │  Value   │  ║
║ • Analytics      │               │               │               │          │  ║
║                  └───────────────┴───────────────┴───────────────┴──────────┘  ║
║ • Reports                                                                       ║
║                  ┌──────────────────────────────────┬──────────────────────────┐ ║
║                  │                                  │                          │ ║
║                  │  Financial Summary               │  Revenue Chart           │ ║
║                  │  • Total Income                  │  ████████░░ $45,000      │ ║
║                  │  • Total Expenses                │  Monthly Breakdown       │ ║
║                  │  • Net Income                    │                          │ ║
║                  │                                  │                          │ ║
║                  └──────────────────────────────────┴──────────────────────────┘ ║
║                                                                                  ║
║                  [Full Width Table/Content Area]                                 ║
║                  ┌──────────────┬──────────┬────────────┬──────────┬────────┐  ║
║                  │ Item         │ Category │ Condition  │ Price    │ Action │  ║
║                  ├──────────────┼──────────┼────────────┼──────────┼────────┤  ║
║                  │ Camera       │ Photo    │ Excellent  │ Rp 50k   │ Edit   │  ║
║                  │ Tripod       │ Photo    │ Good       │ Rp 25k   │ Edit   │  ║
║                  │ Lens Kit     │ Photo    │ Excellent  │ Rp 100k  │ Edit   │  ║
║                  └──────────────┴──────────┴────────────┴──────────┴────────┘  ║
║                                                                                  ║
╚═════════════════════════════════════════════════════════════════════════════════╝

Layout: 4-column grids, multi-column layouts
Spacing: Generous (24px gaps, 32px padding)
Text: Optimized hierarchy with larger sizes
Buttons: Proportional with hover effects
```

---

## Responsive Grid Breakpoints

### 1-2-4 Column Grid
```
Mobile    Tablet    Desktop
[█]       [█][█]    [█][█][█][█]

Each cell is a stat card or component
Gaps: 12px → 16px → 24px
```

### 1-2-3 Column Grid
```
Mobile    Tablet    Desktop
[█]       [█][█]    [█][█][█]

For analytics cards, user grids
Gaps: 12px → 16px → 24px
```

### 1-2 Column Grid
```
Mobile    Desktop
[█]       [█    ][█    ]

For side-by-side sections
Full width on mobile, split on desktop
```

---

## Text Sizing Comparison

```
Mobile          Tablet          Desktop
24px            30px            36px
Page Heading    Page Heading    Page Heading

18px            20px            24px
Section Title   Section Title   Section Title

14px            14px            16px
Body Text       Body Text       Body Text

12px            12px            14px
Label/Caption   Label/Caption   Label/Caption

20px            24px            30px
Large Metric    Large Metric    Large Metric
```

---

## Spacing & Padding Reference

```
Containers
Mobile:    [4px spacing][Content][4px spacing]    (16px horiz padding)
Tablet:    [6px spacing][Content][6px spacing]    (24px horiz padding)
Desktop:   [8px spacing][Content][8px spacing]    (32px horiz padding)

Cards/Boxes
Mobile:    [4px padding]
Tablet:    [6px padding]
Desktop:   [6px padding] (usually no change)

Gaps Between Items
Mobile:    3px gap       (12px)
Tablet:    4px gap       (16px)
Desktop:   6px gap       (24px)
```

---

## Component Scaling Examples

### Stat Card Evolution
```
MOBILE (24px icon)          TABLET (32px icon)       DESKTOP (32px icon)
┌──────────────┐           ┌────────────────────┐   ┌────────────────────┐
│ [●] Title    │           │ [●●]  Title        │   │ [●●●] Title        │
│     Value    │           │       Value        │   │       Value        │
│              │           │                    │   │                    │
└──────────────┘           └────────────────────┘   └────────────────────┘
p-4 (16px)                  p-6 (24px)               p-6 (24px)
```

### Form Field Arrangement
```
MOBILE (Single Column)          TABLET+ (2-4 Columns)
┌──────────────────────┐       ┌──────────────┬──────────────┐
│ Name                 │       │ Name         │ Email        │
│ [─────────────────]  │       │ [──────────] │ [──────────] │
└──────────────────────┘       └──────────────┴──────────────┘
┌──────────────────────┐       ┌──────────────┬──────────────┐
│ Email                │       │ Phone        │ Category     │
│ [─────────────────]  │       │ [──────────] │ [──────────] │
└──────────────────────┘       └──────────────┴──────────────┘
...continues              ...continues in 2x grid
```

### Table Column Visibility
```
MOBILE (Scrollable)         TABLET (More columns)    DESKTOP (All columns)
┌────────────┬────────────┐ ┌───────┬────────┬──────┐ ┌───────┬────────┬───────┬──────┐
│ Image│Name │ Price      │ │ Image │ Name   │ Type │ │ Image │ Name   │ Type  │ Cat  │
├────────────┼────────────┤ ├───────┼────────┼──────┤ ├───────┼────────┼───────┼──────┤
│ [IMG]Camera│ Rp 50,000  │ │[IMG]  │Camera  │Photo │ │[IMG]  │Camera  │Photo  │Lens  │
│ [IMG]Lens  │ Rp 100,000 │ │[IMG]  │Lens    │Photo │ │[IMG]  │Lens    │Photo  │Kit   │
└────────────┴────────────┘ └───────┴────────┴──────┘ └───────┴────────┴───────┴──────┘
[horiz scroll] →              hidden sm:table-cell  visible md:table-cell
```

---

## Navigation & Sidebar

```
MOBILE                      TABLET+
┌─────────────────┐        ┌──────────┬─────────────────┐
│ [≡] Logo  [⚙]  │        │[⊠] Logo  │ Dashboard       │
├─────────────────┤        │[▼]       │ Browse Items    │
│ Dashboard       │        │ Items    │ My Rentals      │
│ Browse Items    │        │[▼]       │ Reports         │
│ My Rentals      │        │ Account  │ Analytics       │
│ Reports         │        │[▼]       │ Financial       │
│ [Menu toggle]   │        │ Admin    │ Settings        │
└─────────────────┘        └──────────┴─────────────────┘
Hamburger menu              Fixed sidebar with menu open
sm:hidden                   hidden sm:flex
```

---

## Button & Input Sizing

```
MOBILE                      TABLET+
┌─────────────────────┐    ┌──────────┬──────────┐
│   [Full Width Btn]  │    │[Button]  │[Button]  │
└─────────────────────┘    └──────────┴──────────┘
width: full              width: auto, inline
height: 44px+            height: 40px+
font: 14px               font: 14px+

Input Fields
┌─────────────────────┐    ┌──────────────────────┐
│ [─────────────────] │    │ [───────────][────────] │
└─────────────────────┘    └──────────────────────┘
Full width               2-column on tablet+
```

---

## Responsive Image Behavior

```
MOBILE (max 100% width)     TABLET (40% width)     DESKTOP (30% width)
┌─────────────────────┐    ┌────────────────┐     ┌──────────────┐
│                     │    │                │     │              │
│ [           ]       │    │ [       ]      │     │ [    ]       │
│ Image scales with   │    │ Proportional   │     │ Constrained  │
│ container width     │    │ scaling        │     │ width        │
│                     │    │                │     │              │
└─────────────────────┘    └────────────────┘     └──────────────┘
width: 100%                width: 40%              width: 30%
```

---

## Hover & Interactive States

```
MOBILE (Touch - No Hover)       DESKTOP (Mouse - With Hover)
┌────────────────────────┐      ┌────────────────────────┐
│ Card                   │      │ Card (default)         │
│ (no shadow change)     │  →   │ ↓                      │
│                        │      │ Card (hover) ↑shadow   │
└────────────────────────┘      └────────────────────────┘

Default: box-shadow: none
Hover: box-shadow: 0 10px 15px rgba(0,0,0,0.1)

Mobile optimizes away hover:
- Prevents visual lag on touch
- Faster response
- Cleaner default appearance
```

---

## Dark Mode Responsive

```
LIGHT MODE              DARK MODE
White backgrounds       Dark/Charcoal backgrounds
Dark text              Light text
Light borders          Dark borders

Responsive classes still apply:
<div class="bg-white dark:bg-zinc-900
            text-gray-900 dark:text-white
            border-gray-200 dark:border-gray-700">
```

---

## Common Mobile Pitfalls

```
❌ DON'T                       ✅ DO
Too much info                 Progressive disclosure
┌────────────────┐           ┌──────────┐
│ Data Data Data │           │ Data     │
│ Data Data Data │           │ [more]   │
│ Data Data Data │           └──────────┘
└────────────────┘

Text too small (< 14px)      Readable size (14px+)
Buttons too small (< 44px)   Touch-friendly (44px+)
Horizontal scroll (except table)  Full width content
Crowded spacing (< 12px)    Comfortable spacing (12px+)
No touch feedback            Tap/click feedback
Fixed width (bad)           Fluid/responsive
```

---

## Device-Specific Considerations

### iOS (iPhone/iPad)
- Rounded corners at edges (account for notch)
- Safe area padding for notched devices
- Touch feedback is built-in
- Supports hover on iPad with mouse

### Android
- More varied screen sizes (360px - 1080px+)
- System buttons at bottom (account for safe area)
- Back gesture navigation
- Haptic feedback on modern devices

### Desktop
- Mouse hover effects
- Keyboard navigation
- Wide viewing angles
- Large screens need proper text line-length (< 80ch)

---

**Visual Design System: Mobile-First, Responsive, Accessible**
*Last Updated: 2025*
