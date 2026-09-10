<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Client-side routes for the Landscape Project Management app
|--------------------------------------------------------------------------
| Wire these up to real controllers/auth logic. Route names are what the
| Blade views use (route('login'), route('dashboard'), etc.) so keep the
| names as-is or update them consistently across the views.
*/

// Public
Route::view('/', 'landing')->name('landing');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', function () {
    // TODO: handle authentication, then redirect()->route('dashboard')
})->name('login.submit');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', function () {
    // TODO: create the client account, then redirect()->route('dashboard')
})->name('register.submit');

Route::view('/password/reset', 'auth.login')->name('password.request'); // replace with real view

Route::post('/logout', function () {
    // TODO: log the user out, then redirect()->route('landing')
})->name('logout');

// Authenticated client area
// Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::view('/projects', 'projects.index')->name('projects.index');
    Route::get('/projects/{project}', function ($project) {
        // TODO: replace demo data with a real Project model lookup by $project (id/slug)
        $projects = [
            'ruiru-family-residence' => [
                'name' => 'Ruiru Family Residence', 'type' => 'Residential', 'size' => '0.4 acres',
                'style' => 'Tropical, Natural', 'started' => 'Jul 2026', 'eta' => 'Oct 2026',
                'status' => 'In progress', 'statusClass' => 'bg-amber-100 text-amber-800 border-amber-200',
                'progress' => 68, 'stage' => 'Procurement',
            ],
            'karen-boutique-hotel-grounds' => [
                'name' => 'Karen Boutique Hotel Grounds', 'type' => 'Hospitality', 'size' => '2.1 acres',
                'style' => 'Mediterranean, Formal', 'started' => 'Aug 2026', 'eta' => 'Feb 2027',
                'status' => 'Awaiting approval', 'statusClass' => 'bg-rose-100 text-rose-800 border-rose-200',
                'progress' => 22, 'stage' => 'Quotation & Approval',
            ],
            'westlands-office-courtyard' => [
                'name' => 'Westlands Office Courtyard', 'type' => 'Commercial', 'size' => '0.2 acres',
                'style' => 'Modern, Minimalist', 'started' => 'Apr 2026', 'eta' => 'Completed Jun 2026',
                'status' => 'Completed', 'statusClass' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                'progress' => 100, 'stage' => 'Handed over',
            ],
        ];

        return view('projects.show', [
            'project' => $projects[$project] ?? $projects['ruiru-family-residence'],
        ]);
    })->name('projects.show');

    Route::get('/projects-new', function () {
        return view('projects.create');
    })->name('projects.create');
    Route::post('/projects', function () {
        // TODO: validate + persist the new project request, then redirect()->route('projects.index')
    })->name('projects.store');

    Route::view('/quotations', 'quotations.index')->name('quotations.index');
    Route::get('/quotations/{quotation}', function ($quotation) {
        // TODO: replace demo data with a real Quotation model lookup by $quotation (ref/id)
        $quotations = [
            'QT-2026-014' => [
                'ref' => 'QT-2026-014', 'project' => 'Ruiru Family Residence', 'date' => 'Aug 12, 2026',
                'validUntil' => 'Sep 12, 2026', 'amount' => 'KSh 1,800,000',
                'status' => 'Approved', 'statusClass' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                'items' => [
                    ['item' => 'Olive Tree (mature)', 'category' => 'Trees', 'qty' => 12, 'unit' => 'KSh 18,000', 'total' => 'KSh 216,000'],
                    ['item' => 'Lavender', 'category' => 'Shrubs & groundcover', 'qty' => 80, 'unit' => 'KSh 850', 'total' => 'KSh 68,000'],
                    ['item' => 'Irrigation system (drip)', 'category' => 'Irrigation', 'qty' => 1, 'unit' => 'KSh 480,000', 'total' => 'KSh 480,000'],
                    ['item' => 'Labour (10 weeks)', 'category' => 'Labour', 'qty' => 1, 'unit' => 'KSh 1,036,000', 'total' => 'KSh 1,036,000'],
                ],
                'revisions' => [
                    ['title' => 'Approved by client', 'note' => 'No changes requested.', 'date' => 'Aug 14, 2026'],
                    ['title' => 'Quotation sent', 'note' => 'Initial version, 4 line items.', 'date' => 'Aug 12, 2026'],
                ],
            ],
            'QT-2026-021' => [
                'ref' => 'QT-2026-021', 'project' => 'Karen Boutique Hotel', 'date' => 'Sep 3, 2026',
                'validUntil' => 'Oct 3, 2026', 'amount' => 'KSh 4,250,000',
                'status' => 'Awaiting approval', 'statusClass' => 'bg-amber-100 text-amber-800 border-amber-200',
                'items' => [
                    ['item' => 'Olive Tree (mature)', 'category' => 'Trees', 'qty' => 12, 'unit' => 'KSh 18,000', 'total' => 'KSh 216,000'],
                    ['item' => 'Bamboo Palm', 'category' => 'Trees', 'qty' => 18, 'unit' => 'KSh 6,500', 'total' => 'KSh 117,000'],
                    ['item' => 'Irrigation system (drip)', 'category' => 'Irrigation', 'qty' => 1, 'unit' => 'KSh 480,000', 'total' => 'KSh 480,000'],
                    ['item' => 'Paving & hardscape', 'category' => 'Hardscape', 'qty' => 1, 'unit' => 'KSh 1,250,000', 'total' => 'KSh 1,250,000'],
                    ['item' => 'Labour (14 weeks)', 'category' => 'Labour', 'qty' => 1, 'unit' => 'KSh 2,187,000', 'total' => 'KSh 2,187,000'],
                ],
                'revisions' => [
                    ['title' => 'Revision #2 sent', 'note' => 'Swapped hardscape material per client request.', 'date' => 'Sep 3, 2026'],
                    ['title' => 'Revision requested', 'note' => 'Client asked for a lower-cost paving option.', 'date' => 'Aug 29, 2026'],
                    ['title' => 'Quotation sent', 'note' => 'Initial version, 5 line items.', 'date' => 'Aug 20, 2026'],
                ],
            ],
            'QT-2026-007' => [
                'ref' => 'QT-2026-007', 'project' => 'Westlands Office Courtyard', 'date' => 'Jun 2, 2026',
                'validUntil' => 'Jul 2, 2026', 'amount' => 'KSh 620,000',
                'status' => 'Paid', 'statusClass' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                'items' => [
                    ['item' => 'Succulents (mixed)', 'category' => 'Groundcover', 'qty' => 60, 'unit' => 'KSh 950', 'total' => 'KSh 57,000'],
                    ['item' => 'Gravel & mulch', 'category' => 'Materials', 'qty' => 1, 'unit' => 'KSh 145,000', 'total' => 'KSh 145,000'],
                    ['item' => 'Labour (4 weeks)', 'category' => 'Labour', 'qty' => 1, 'unit' => 'KSh 418,000', 'total' => 'KSh 418,000'],
                ],
                'revisions' => [
                    ['title' => 'Payment received', 'note' => 'Full amount settled.', 'date' => 'Jun 5, 2026'],
                    ['title' => 'Approved by client', 'note' => 'No changes requested.', 'date' => 'Jun 3, 2026'],
                    ['title' => 'Quotation sent', 'note' => 'Initial version, 3 line items.', 'date' => 'Jun 2, 2026'],
                ],
            ],
        ];

        return view('quotations.show', [
            'quotation' => $quotations[$quotation] ?? $quotations['QT-2026-014'],
        ]);
    })->name('quotations.show');

    Route::view('/messages', 'messages.index')->name('messages.index');
    // TODO: Route::post('/messages', ...)->name('messages.store');

    Route::view('/notifications', 'notifications.index')->name('notifications.index');

    Route::view('/profile', 'profile')->name('profile');
    Route::put('/profile', function () { /* TODO: update profile */ })->name('profile.update');
    Route::post('/profile/password', function () { /* TODO: update password */ })->name('profile.password');
// });
