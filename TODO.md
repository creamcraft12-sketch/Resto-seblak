# TODO List for Admin Dashboard and Multi-Channel Ordering System

## 1. Admin Dashboard with Login
- [ ] Create Admin model and migration (if separate from User)
- [ ] Add admin role to User model (or create separate Admin model)
- [ ] Create AdminController for dashboard functionality
- [ ] Create admin login view (separate from customer login)
- [ ] Add admin routes (middleware for admin access)
- [ ] Create admin dashboard view with menu management, order monitoring, sales reports

## 2. Menu Management (Admin)
- [ ] Create Menu model and migration
- [ ] Add CRUD operations in AdminController for menus
- [ ] Create menu management views (list, create, edit, delete)
- [ ] Add image upload functionality for menu items
- [ ] Update existing menu views to fetch from database instead of hardcoded

## 3. Order Monitoring (Admin)
- [ ] Create admin order list view
- [ ] Add order status update functionality
- [ ] Add order details view
- [ ] Implement real-time order updates (optional with websockets)

## 4. Sales Reports (Admin)
- [ ] Create sales report view with date filters
- [ ] Add sales analytics (total revenue, popular items, etc.)
- [ ] Export reports to PDF/Excel

## 5. Multi-Channel Ordering Enhancements
- [ ] Enhance Dine-In: Add QR code generation for tables
- [ ] Enhance Takeaway: Add pickup time selection
- [ ] Enhance Delivery: Add delivery fee calculation
- [ ] Add session management for different channels

## 6. Payment Gateway Enhancements
- [ ] Implement 15-minute timer for payment expiry
- [ ] Add auto-check status every 20 seconds
- [ ] Add payment success/failure notifications
- [ ] Improve QR code download functionality

## 7. Customer Order Form Improvements
- [ ] Update "Pesan Sekarang" buttons to pass menu data to order form
- [ ] Add menu search/filter functionality
- [ ] Improve UI/UX for order form

## 8. Database Updates
- [ ] Create menus table migration
- [ ] Add admin role to users table (if needed)
- [ ] Update orders table if needed for new features

## 9. Testing and Validation
- [ ] Test admin login and dashboard access
- [ ] Test menu CRUD operations
- [ ] Test order monitoring
- [ ] Test multi-channel ordering
- [ ] Test payment flow with Midtrans

## 10. Security and Permissions
- [ ] Add middleware for admin routes
- [ ] Ensure proper authentication and authorization
- [ ] Add CSRF protection for forms
