# Button Styling Guide - Header & Footer

## Button Classification System

The header and footer now use a clear button classification system to provide visual hierarchy and consistency across the interface.

## Primary Buttons

### `.header-btn.primary` (Sign Up)

**Purpose**: Main action buttons that drive user engagement (sign ups, creating accounts)

**Visual Design**:
```css
Background: Linear gradient from #00ffff (cyan) to #00ff88 (lime green)
Color: #0a0520 (dark text for contrast)
Border: 1.5px solid #00ffff
Box-shadow: 
  - 0 0 15px rgba(0, 255, 255, 0.4) [outer cyan glow]
  - 0 4px 12px rgba(0, 255, 255, 0.2) [depth shadow]
```

**Normal State**:
- Gradient background: Cyan → Lime Green
- Bright and eye-catching
- Glowing cyan border
- Elevated appearance

**Hover State**:
- Gradient reversed: Lime Green → Cyan
- Enhanced glow (0 0 25px rgba(0, 255, 255, 0.6))
- Elevated position (translateY -3px)
- Larger shadow effect
- Animation: Smooth 0.3s transition

**Responsive Behavior**:
- Desktop: 18px padding, full text
- Tablet (1024px): 14px padding, slightly smaller text
- Mobile (768px): 12px padding, uppercase labels

**HTML Example**:
```html
<li><a class='header-btn primary' href='signup.php'>Sign Up</a></li>
```

---

## Secondary Buttons

### `.header-btn.secondary` (Login, Logout, Cart, Admin, Profile)

**Purpose**: Standard action buttons for common user interactions

**Visual Design**:
```css
Background: Transparent
Border: 1.5px solid rgba(0, 255, 255, 0.4)
Color: #ffffff (white text)
Box-shadow: 
  - Inset 0 0 10px rgba(0, 255, 255, 0.05) [subtle inner glow]
```

**Normal State**:
- Transparent background shows dark header
- Cyan border (40% opacity)
- White text
- Subtle inset glow for depth

**Hover State**:
- Background: rgba(0, 255, 255, 0.12) [subtle background appears]
- Border: rgba(0, 255, 255, 0.8) [border brightens]
- Color: #00ffff [text becomes cyan]
- Text-shadow: 0 0 8px rgba(0, 255, 255, 0.5) [cyan glow on text]
- Box-shadow: 
  - 0 0 15px rgba(0, 255, 255, 0.3) [outer glow appears]
  - Inset 0 0 10px rgba(0, 255, 255, 0.1) [inner glow intensifies]
- Position: Elevated (translateY -3px)
- Animation: Smooth 0.3s transition

**Responsive Behavior**:
- Desktop: 18px padding, 13px font
- Tablet (1024px): 14px padding, 12px font
- Mobile (768px): 12px padding, 10px font

**HTML Examples**:
```html
<!-- Login -->
<li><a class='header-btn secondary' href='login.php'>Login</a></li>

<!-- Logout -->
<li><a class='header-btn secondary' href='includes/logout.inc.php'>Logout</a></li>

<!-- Cart -->
<li><a class='header-btn secondary' href='cart.php?member_id=$memberID'>
  Cart<span class='badge' id='cart_badge'>5</span>
</a></li>

<!-- Admin Panel -->
<li><a class='header-btn secondary' href='admin.php' target='_blank'>Admin Panel</a></li>

<!-- Manage Profile -->
<li><a class='header-btn secondary' href='manage_profile.php?email=$email'>Manage Profile</a></li>
```

---

## Cart Badge

### `.badge`

**Purpose**: Notification indicator for cart item count

**Visual Design**:
```css
Background: Linear gradient from #ff00ff (magenta) to #ff0088 (hot pink)
Color: #ffffff (white)
Border-radius: 12px (pill-shaped)
Font-weight: 700
Box-shadow: 0 0 10px rgba(255, 0, 255, 0.5) [magenta glow]
```

**Display**:
- Position: Top-right of cart text
- Size: 4px padding, 8px horizontal
- Font-size: 11px (small)
- Always visible when count > 0

**HTML Example**:
```html
<span class='badge' id='cart_badge'>5</span>
```

---

## Footer Social Buttons

### `.btn` (in footer)

**Purpose**: Links to social media platforms

**Visual Design** (Footer-specific):
```css
Background: Linear gradient(135deg,
  rgba(0, 255, 255, 0.15) 0%,
  rgba(138, 43, 226, 0.1) 100%)
Border: 1px solid rgba(0, 255, 255, 0.3)
Color: #ffffff
Font-weight: 600
Box-shadow: 0 0 10px rgba(0, 255, 255, 0.2)
```

**Normal State**:
- Subtle gradient background
- Cyan border with transparency
- White text
- Soft glow effect

**Hover State**:
- Enhanced gradient (colors more visible)
- Border: rgba(0, 255, 255, 0.6) [brightens]
- Color: #00ffff [text becomes cyan]
- Text-shadow: 0 0 8px rgba(0, 255, 255, 0.5)
- Box-shadow: 0 0 15px rgba(0, 255, 255, 0.4) [glow intensifies]
- Position: Elevated (translateY -2px)
- Animation: Smooth 0.3s transition

**HTML Example**:
```html
<a class="waves-effect waves-light btn" style="margin: 4px;">
  <i class="fa fa-facebook fa-fw"></i> Facebook
</a>
```

---

## Search Bar Button

### Search Submit Button (in header)

**Purpose**: Submit product search query

**Visual Design**:
```css
Background: Linear gradient(135deg,
  rgba(0, 255, 255, 0.2) 0%,
  rgba(138, 43, 226, 0.1) 100%)
Border: 1.5px solid rgba(0, 255, 255, 0.3)
Color: #00ffff
Width: 48px
Height: 44px
```

**Normal State**:
- Subtle gradient background
- Cyan border
- Cyan icon color
- Small glow effect

**Hover State**:
- Enhanced gradient
- Border: rgba(0, 255, 255, 0.6)
- Box-shadow: 0 0 15px rgba(0, 255, 255, 0.4)
- Animation: Smooth 0.3s transition

**HTML Example**:
```html
<button type="submit">
  <i class='material-icons'>search</i>
</button>
```

---

## Button Properties Reference

### Common Properties

**Font Settings**:
- Font-family: 'Inter' (from header imports)
- Font-weight: 500-700 (varies by button type)
- Font-size: 12-13px (adjusted for screen size)
- Text-transform: uppercase (all buttons)
- Letter-spacing: 0.5px-0.7px

**Spacing**:
- Padding: 10px 18px (desktop, primary)
- Padding: 10px 14px (desktop, secondary)
- Margin: 0 6px (between buttons)
- Min-height: 44px (touch-friendly minimum)

**Transitions**:
- Duration: 0.3s
- Timing: cubic-bezier(0.4, 0, 0.2, 1)
- Properties: background, border-color, color, transform, box-shadow

**Border Radius**:
- Primary: 8px
- Secondary: 8px
- Badge: 12px (pill-shaped)
- Search button: 8px

---

## Visual Hierarchy

### Button Importance Order

1. **Primary Action** (`.header-btn.primary`)
   - Sign Up
   - Brightest colors
   - Strongest visual presence
   - Catches attention

2. **Secondary Actions** (`.header-btn.secondary`)
   - Login, Logout, Cart, Profile, Admin
   - Subtle styling
   - Clear but not dominant
   - Professional appearance

3. **Tertiary Actions** (Footer buttons)
   - Social links
   - Lightest styling
   - Footer context
   - Supporting links

---

## Color Coding for Users

Users intuitively understand:
- **Bright Gradient (Cyan→Green)** = Main action I should take (Sign Up)
- **Light Border (No Fill)** = Secondary options I might use (Login, Cart, etc.)
- **Dark Background** = Context/navigation buttons (Admin Panel)
- **Magenta Badge** = Important counter (new items in cart)

---

## Accessibility Considerations

✅ **Focus States**
- All buttons have visible focus outlines
- Keyboard navigation fully supported
- Tab order logical and intuitive

✅ **Color Contrast**
- Primary buttons: Dark text on bright gradient (WCAG AAA)
- Secondary buttons: White text on dark background (WCAG AA)
- Links: Underline appears on hover for clarity

✅ **Touch Friendly**
- Minimum touch target: 44x44px
- Padding ensures adequate spacing
- No overlapping buttons

✅ **Reduced Motion**
- Animations disabled when user prefers reduced motion
- Buttons still functional and clear
- Instant state changes instead of animated

---

## CSS Classes Summary

| Class | Purpose | Primary Color |
|-------|---------|---------------|
| `.header-btn.primary` | Main actions (Sign Up) | #00ff88 (Lime) |
| `.header-btn.secondary` | Secondary actions (Login, etc.) | #00ffff (Cyan) |
| `.badge` | Notification counter | #ff00ff (Magenta) |
| `.btn` (footer) | Social media links | #00ffff (Cyan) |

---

## Implementation Notes

1. **All button styling is in `header-footer.css`**
   - No inline styles
   - Consistent across all pages
   - Easy to maintain

2. **JavaScript-free**
   - Pure CSS styling
   - No dependencies
   - Fast performance

3. **Responsive**
   - Automatically scales on mobile
   - Touch-friendly sizing
   - Readable at all breakpoints

4. **Backward Compatible**
   - Old button IDs/names preserved
   - Form actions unchanged
   - Existing HTML structure works

---

## Testing Button Functionality

1. **Visual Test**: Buttons display with correct styling
2. **Hover Test**: Effects smooth and appropriate
3. **Focus Test**: Tab through buttons, focus visible
4. **Click Test**: Links navigate correctly
5. **Mobile Test**: Buttons resize appropriately
6. **Keyboard Test**: All buttons keyboard-accessible

---

**Status**: ✅ Button system complete and tested
**Consistency**: All buttons follow gamer theme standards
**Functionality**: All links and forms preserved
**Accessibility**: WCAG AA compliant
