<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$cats_query = "SELECT cat_id, cat_name, img, description FROM cat_tbl";
$cats_result = $conn->query($cats_query);

$cats = [];
if ($cats_result) {
    while ($row = $cats_result->fetch_assoc()) {
        $cats[] = $row;
    }
}

$menu_query = "SELECT * FROM menuitem_tbl ORDER BY category, item_name ASC";
$menu_result = $conn->query($menu_query);

$categorized_menu = [];
if ($menu_result) {
    while ($item = $menu_result->fetch_assoc()) {
        $cat_group = strtolower($item['category']);
        if (strpos($cat_group, 'brownie') !== false) {
            $categorized_menu['Brownies'][] = $item;
        } elseif (strpos($cat_group, 'cookie') !== false) {
            $categorized_menu['Cookies'][] = $item;
        } elseif (strpos($cat_group, 'cake') !== false) {
            $categorized_menu['Cakes'][] = $item;
        } else {
            $categorized_menu['Drinks & Refreshments'][] = $item;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Your Order - Cat Cafe Lounge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/checkout.css">
    <style>
        .cat-selection-scroll {
            max-height: 420px;
            overflow-y: auto;
            padding-right: 6px;
        }

        .cat-selection-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .cat-selection-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .cat-selection-scroll::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        .cat-card-professional {
            border: 2px solid #e9ecef;
            border-radius: 1rem;
            transition: all 0.25s ease-in-out;
            cursor: pointer;
            background-color: #ffffff;
        }

        .cat-card-professional:hover {
            transform: translateY(-2px);
            border-color: #adb5bd;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08) !important;
        }

        .cat-card-professional.selected {
            border-color: #212529 !important;
            background-color: #f8f9fa;
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05) !important;
        }

        .cat-card-professional.disabled-card {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none !important;
            box-shadow: none !important;
            border-color: #e9ecef !important;
        }

        .cat-avatar-frame {
            width: 72px;
            height: 72px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #f8f9fa;
        }

        .cat-card-professional.selected .cat-avatar-frame {
            border-color: #212529;
        }
    </style>
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="checkout-page-wrapper">
        <div class="container-xl">

            <div class="flow-stepper">
                <div class="step-circle active" id="circle-type">1</div>
                <div class="step-circle" id="circle-query">2</div>
                <div class="step-circle" id="circle-cat">3</div>
                <div class="step-circle" id="circle-schedule">4</div>
            </div>

            <div class="row g-4 justify-content-center">

                <div class="col-lg-7 col-xl-8">
                    <div class="card flow-card p-4 p-md-5">

                        <div id="step-type" class="step-container active">
                            <div style="font-family:'Playfair Display',serif;" class="fw-bold text-dark mb-1">Choose Service Method</div>
                            <div class="text-muted small mb-4">Select how you'd like to enjoy your treats today.</div>

                            <div class="row g-3 mb-5">
                                <div class="col-sm-6">
                                    <button class="option-btn-card p-4 d-flex flex-column gap-2" onclick="setOrderType('Delivery')">
                                        <i class="bi bi-truck fs-2 text-dark"></i>
                                        <span class="fw-bold fs-5 text-dark d-block mb-0">Home Delivery</span>
                                        <span class="text-muted small lh-sm">Fresh batches delivered right to your location.</span>
                                    </button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="option-btn-card p-4 d-flex flex-column gap-2" onclick="setOrderType('Pre-order')">
                                        <i class="bi bi-calendar-heart fs-2 text-dark"></i>
                                        <span class="fw-bold fs-5 text-dark d-block mb-0">Pre-Order & Visit Lounge</span>
                                        <span class="text-muted small lh-sm">Book a visit and play with our resident cats.</span>
                                    </button>
                                </div>
                            </div>

                            <div class="bg-light bg-opacity-70 rounded-4 p-4 border border-light shadow-sm">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="bi bi-plus-circle-fill text-dark fs-5"></i>
                                    <div class="fw-bold mb-0 text-dark">Want to add more treats?</div>
                                </div>
                                <div class="text-muted small mb-3">Browse our categories and add extras directly into your order.</div>

                                <div class="accordion accordion-flush bg-transparent" id="extraMenuAccordion">
                                    <?php $acc_index = 0;
                                    foreach ($categorized_menu as $category_name => $items_list): $acc_index++; ?>
                                        <div class="accordion-item bg-white shadow-sm border-0 rounded-3 mb-2">
                                            <div class="accordion-header">
                                                <button class="accordion-button collapsed fw-semibold text-dark small" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapse-<?= $acc_index ?>">
                                                    <?= $category_name ?> (<?= count($items_list) ?> items)
                                                </button>
                                            </div>
                                            <div id="flush-collapse-<?= $acc_index ?>" class="accordion-collapse collapse" data-bs-parent="#extraMenuAccordion">
                                                <div class="accordion-body p-2">
                                                    <div class="d-flex flex-column gap-2">
                                                        <?php foreach ($items_list as $menu_item): ?>
                                                            <div class="d-flex align-items-center justify-content-between p-2 rounded bg-light bg-opacity-40">
                                                                <div class="d-flex align-items-center gap-3">
                                                                    <?php if (!empty($menu_item['image'])): ?>
                                                                        <img src="<?= htmlspecialchars($menu_item['image']) ?>" class="inline-menu-img border" alt="treat">
                                                                    <?php else: ?>
                                                                        <div class="inline-menu-img bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center text-muted">
                                                                            <i class="bi bi-image"></i>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <div>
                                                                        <div class="mb-0 fw-bold small text-dark"><?= htmlspecialchars($menu_item['item_name']) ?></div>
                                                                        <span class="text-muted small">₱<?= number_format($menu_item['price'], 2) ?></span>
                                                                    </div>
                                                                </div>
                                                                <button class="btn btn-outline-dark btn-mini-add"
                                                                    onclick="addExtraToBag('<?= $menu_item['item_id'] ?>', '<?= htmlspecialchars($menu_item['item_name'], ENT_QUOTES) ?>', '<?= $menu_item['price'] ?>', this)">
                                                                    <i class="bi bi-plus-lg"></i> Add
                                                                </button>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <div id="step-cat-query" class="step-container">
                            <div style="font-family:'Playfair Display',serif;" class="fw-bold text-dark mb-1">Lounge Group Details</div>
                            <div class="text-muted small mb-4">How many guests will be visiting? You may optionally choose one resident cat to keep you company.</div>

                            <div class="mx-auto mb-4" style="max-width:450px;">
                                <label for="guestCount" class="form-label small fw-semibold text-secondary">Number of Guests</label>
                                <select class="form-select form-select-lg rounded-3 mb-4" id="guestCount" onchange="handleGuestCountChange()">
                                    <option value="1" selected>1 Guest</option>
                                    <option value="2">2 Guests</option>
                                    <option value="3">3 Guests</option>
                                    <option value="4">4 Guests</option>
                                    <option value="5">5 Guests</option>
                                </select>

                                <div class="d-grid gap-3">
                                    <button type="button" class="btn btn-dark btn-lg py-3 fs-6 fw-medium shadow-sm rounded-3"
                                        onclick="navigateToStep('step-cat-select')">Proceed to Select Cat Companions</button>
                                    <button type="button" class="btn btn-outline-secondary btn-lg py-3 fs-6 rounded-3"
                                        onclick="skipCatSelection()">No Cats, just book a visit</button>
                                </div>
                            </div>
                            <button class="btn btn-link btn-sm text-dark d-block mx-auto mt-4 text-decoration-none small"
                                onclick="navigateToStep('step-type')">
                                <i class="bi bi-chevron-left"></i> Back to Step 1
                            </button>
                        </div>

                        <div id="step-cat-select" class="step-container">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <div style="font-family:'Playfair Display',serif;" class="fw-bold text-dark mb-0">Select a Cat Companion</div>
                                <span class="badge bg-dark rounded-pill py-2 px-3 fw-medium" id="catLimitCounter">Selected: 0 / 1</span>
                            </div>
                            <div class="text-muted small mb-3">Optionally pick one of our cafe hosts to join you — or continue without one.</div>

                            <div class="alert alert-warning py-2 px-3 small d-none align-items-center gap-2 rounded-3 mb-3" id="catLimitWarning">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                <span>Selection limit reached for your group!</span>
                            </div>

                            <div class="row g-3 cat-selection-scroll mb-4">
                                <?php if (!empty($cats)): ?>
                                    <?php foreach ($cats as $cat): ?>
                                        <div class="col-12">
                                            <div class="cat-card-professional p-3 d-flex align-items-center justify-content-between shadow-sm"
                                                data-id="<?= $cat['cat_id'] ?>"
                                                data-name="<?= htmlspecialchars($cat['cat_name']) ?>"
                                                onclick="toggleCatSelection(this)">
                                                <div class="d-flex align-items-center gap-3">
                                                    <?php if (!empty($cat['img'])): ?>
                                                        <?php $webPath = str_replace(['\\', 'C:/wamp64/www/cafe/'], ['/', ''], $cat['img']); ?>
                                                        <img src="<?= htmlspecialchars($webPath) ?>" class="cat-avatar-frame shadow-sm" alt="<?= htmlspecialchars($cat['cat_name']) ?>">
                                                    <?php else: ?>
                                                        <div class="cat-avatar-frame bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center text-secondary border border-2 border-light shadow-sm">
                                                            <i class="bi bi-heart-fill fs-4"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div>
                                                        <div class="fw-bold mb-1 text-dark text-capitalize" style="font-size:1.05rem;"><?= htmlspecialchars($cat['cat_name']) ?></div>
                                                        <div class="text-muted mb-0 small lh-sm" style="max-width:480px;"><?= htmlspecialchars($cat['description'] ?? 'Friendly and playful lounge companion.') ?></div>
                                                    </div>
                                                </div>
                                                <div class="pe-2">
                                                    <i class="bi bi-check-circle-fill text-dark fs-3 check-icon d-none"></i>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="text-center py-5 text-muted small bg-light rounded-4 border">
                                        <i class="bi bi-database-exclamation d-block fs-2 mb-2 text-secondary"></i>
                                        No cats found in the database.
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4 border-top pt-3">
                                <button class="btn btn-outline-secondary btn-sm px-4 rounded-pill" onclick="navigateToStep('step-cat-query')">Back</button>
                                <button class="btn btn-dark btn-sm px-4 rounded-pill shadow-sm fw-medium" onclick="navigateToStep('step-schedule')">Continue</button>
                            </div>
                        </div>

                        <div id="step-schedule" class="step-container">
                            <div style="font-family:'Playfair Display',serif;" class="fw-bold text-dark mb-1">Schedule Your Visit</div>
                            <div class="text-muted small mb-4">When should we prepare your order and reserve your spot?</div>

                            <form id="checkoutForm" action="order_summary.php" method="POST">
                                <input type="hidden" name="order_type" id="formOrderType">
                                <input type="hidden" name="guest_count" id="formGuestCount">
                                <input type="hidden" name="cat_ids" id="formCatIds">
                                <input type="hidden" name="cart_json" id="formCartJson">

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-semibold text-secondary">Reservation Date</label>
                                        <input type="date" name="booking_date" class="form-control form-control-lg fs-6 rounded-3"
                                            id="flowDate" required min="<?= date('Y-m-d') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-semibold text-secondary">Arrival Time</label>
                                        <input type="time" name="booking_time" class="form-control form-control-lg fs-6 rounded-3"
                                            id="flowTime" required>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-4 border-top pt-3">
                                    <button type="button" class="btn btn-outline-secondary btn-sm px-4 rounded-pill"
                                        id="btnScheduleBack" onclick="navigateToStep('step-cat-select')">Back</button>
                                    <button type="submit" class="btn btn-dark btn-sm px-4 rounded-pill fw-medium shadow-sm">
                                        Proceed to Order Summary <i class="bi bi-arrow-right ms-1"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5 col-xl-4">
                    <div class="card summary-card p-4">
                        <div style="font-family:'Playfair Display',serif;" class="fw-bold text-dark mb-3 pb-2 border-bottom">Order Summary</div>

                        <div id="summaryBagItems" class="mb-4" style="max-height:240px; overflow-y:auto; padding-right:4px;">
                            <div class="text-center text-muted py-3 small">Your basket is currently empty.</div>
                        </div>

                        <div class="bg-light rounded-3 p-3 mb-4 border border-light small" id="summaryMetaBlock" style="display:none;">
                            <div class="fw-bold mb-2 text-dark text-uppercase" style="font-size:0.75rem;">Booking Details</div>
                            <div class="d-flex justify-content-between text-muted mb-1" id="metaTypeRow" style="display:none;"><span>Service:</span> <strong class="text-dark" id="lblMetaType">-</strong></div>
                            <div class="d-flex justify-content-between text-muted mb-1" id="metaGuestsRow" style="display:none;"><span>Guests:</span> <strong class="text-dark" id="lblMetaGuests">-</strong></div>
                            <div class="d-flex justify-content-between text-muted mb-1" id="metaCatRow" style="display:none;"><span>Cats:</span> <strong class="text-dark" id="lblMetaCat">-</strong></div>
                            <div class="d-flex justify-content-between text-muted" id="metaSchedRow" style="display:none;"><span>Schedule:</span> <strong class="text-dark" id="lblMetaSched">-</strong></div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                            <div>
                                <span class="text-muted d-block small fw-medium">GRAND TOTAL</span>
                                <span class="text-muted text-uppercase" style="font-size:10px;">VAT Inclusive</span>
                            </div>
                            <div class="fw-bold text-dark mb-0" id="lblGrandTotal">₱0.00</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let chosenCatsArray = [];

        document.addEventListener('DOMContentLoaded', () => {
            renderSummarySidebar();
            document.getElementById('flowDate').addEventListener('change', updateMetaSummaryView);
            document.getElementById('flowTime').addEventListener('change', updateMetaSummaryView);
            localStorage.setItem('guest_count', document.getElementById('guestCount').value);
        });

        function renderSummarySidebar() {
            const container = document.getElementById('summaryBagItems');
            const totalLabel = document.getElementById('lblGrandTotal');
            let currentBag = JSON.parse(localStorage.getItem('cafe_bag')) || [];

            if (currentBag.length === 0) {
                container.innerHTML = '<div class="text-center text-muted py-4 small"><i class="bi bi-cart-x d-block fs-3 mb-2"></i>No items in your bag yet.</div>';
                totalLabel.innerText = "₱0.00";
                return;
            }

            let html = "",
                total = 0;
            currentBag.forEach(item => {
                let rowTotal = item.price * item.quantity;
                total += rowTotal;
                html += `
            <div class="d-flex align-items-start justify-content-between mb-3">
                <div style="max-width:70%;">
                    <div class="mb-0 fw-semibold text-dark small text-truncate">${item.name}</div>
                    <span class="text-muted" style="font-size:0.75rem;">₱${parseFloat(item.price).toFixed(2)} × ${item.quantity}</span>
                </div>
                <span class="fw-bold text-dark small">₱${rowTotal.toFixed(2)}</span>
            </div>`;
            });

            container.innerHTML = html;
            totalLabel.innerText = "₱" + total.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            updateMetaSummaryView();
        }

        function addExtraToBag(id, name, price, btn) {
            let bag = JSON.parse(localStorage.getItem('cafe_bag')) || [];
            const idx = bag.findIndex(i => i.id === id);
            if (idx > -1) {
                bag[idx].quantity += 1;
            } else {
                bag.push({
                    id,
                    name,
                    price: parseFloat(price),
                    quantity: 1
                });
            }
            localStorage.setItem('cafe_bag', JSON.stringify(bag));
            renderSummarySidebar();

            btn.className = "btn btn-success btn-mini-add text-white border-success";
            btn.innerHTML = '<i class="bi bi-check2"></i> Added!';
            btn.disabled = true;
            setTimeout(() => {
                btn.className = "btn btn-outline-dark btn-mini-add";
                btn.innerHTML = '<i class="bi bi-plus-lg"></i> Add';
                btn.disabled = false;
            }, 1200);
        }

        function handleGuestCountChange() {
            const val = document.getElementById('guestCount').value;
            localStorage.setItem('guest_count', val);

            updateCatUiLimits();
            updateMetaSummaryView();
        }

        function updateCatUiLimits() {
            const maxCats = 1;
            document.getElementById('catLimitCounter').innerText = `Selected: ${chosenCatsArray.length} / ${maxCats}`;
            const warning = document.getElementById('catLimitWarning');
            if (chosenCatsArray.length >= maxCats) {
                warning.classList.remove('d-none');
                warning.classList.add('d-flex');
                document.querySelectorAll('.cat-card-professional').forEach(c => {
                    if (!c.classList.contains('selected')) c.classList.add('disabled-card');
                });
            } else {
                warning.classList.add('d-none');
                warning.classList.remove('d-flex');
                document.querySelectorAll('.cat-card-professional').forEach(c => c.classList.remove('disabled-card'));
            }
        }

        function toggleCatSelection(card) {
            const catId = card.getAttribute('data-id');
            const catName = card.getAttribute('data-name');
            const idx = chosenCatsArray.findIndex(i => i.id === catId);

            if (idx > -1) {
                chosenCatsArray.splice(idx, 1);
                card.classList.remove('selected');
                card.querySelector('.check-icon').classList.add('d-none');
            } else {
               
                if (chosenCatsArray.length >= 1) {
                    const prevId = chosenCatsArray[0].id;
                    const prevCard = document.querySelector(`.cat-card-professional[data-id="${prevId}"]`);
                    if (prevCard) {
                        prevCard.classList.remove('selected');
                        prevCard.querySelector('.check-icon').classList.add('d-none');
                    }
                    chosenCatsArray = [];
                }
                chosenCatsArray.push({
                    id: catId,
                    name: catName
                });
                card.classList.add('selected');
                card.querySelector('.check-icon').classList.remove('d-none');
            }

            localStorage.setItem('summary_cat_names', chosenCatsArray.map(c => c.name).join(', '));
            localStorage.setItem('selected_cats_json', JSON.stringify(chosenCatsArray));
            updateCatUiLimits();
            updateMetaSummaryView();
        }

        function skipCatSelection() {
            chosenCatsArray = [];
            localStorage.removeItem('selected_cats_json');
            localStorage.removeItem('summary_cat_names');
            document.querySelectorAll('.cat-card-professional').forEach(c => {
                c.classList.remove('selected', 'disabled-card');
                c.querySelector('.check-icon').classList.add('d-none');
            });
            document.getElementById('btnScheduleBack').setAttribute('onclick', "navigateToStep('step-cat-query')");
            navigateToStep('step-schedule');
        }

        function updateMetaSummaryView() {
            const metaBlock = document.getElementById('summaryMetaBlock');
            const typeVal = localStorage.getItem('order_type');
            const guestVal = localStorage.getItem('guest_count');
            const catNames = localStorage.getItem('summary_cat_names');
            const dateVal = document.getElementById('flowDate').value;
            const timeVal = document.getElementById('flowTime').value;

            let showingAny = false;

            const setRow = (rowId, labelId, show, text) => {
                document.getElementById(rowId).style.display = show ? 'flex' : 'none';
                if (show) {
                    document.getElementById(labelId).innerText = text;
                    showingAny = true;
                }
            };

            setRow('metaTypeRow', 'lblMetaType', !!typeVal, typeVal);
            setRow('metaGuestsRow', 'lblMetaGuests', typeVal === 'Pre-order' && !!guestVal, `${guestVal} Pax`);
            setRow('metaCatRow', 'lblMetaCat', typeVal === 'Pre-order' && chosenCatsArray.length > 0, catNames);
            setRow('metaSchedRow', 'lblMetaSched', typeVal === 'Pre-order' && (!!dateVal || !!timeVal), `${dateVal || '--'} @ ${timeVal || '--'}`);

            metaBlock.style.display = showingAny ? 'block' : 'none';
        }

        function navigateToStep(stepId) {
            document.querySelectorAll('.step-container').forEach(s => s.classList.remove('active'));
            document.getElementById(stepId).classList.add('active');

            const stepMap = {
                'step-type': 1,
                'step-cat-query': 2,
                'step-cat-select': 3,
                'step-schedule': 4
            };
            const current = stepMap[stepId];

            document.querySelectorAll('.step-circle').forEach((circle, idx) => {
                circle.classList.remove('active', 'completed');
                if (idx + 1 === current) circle.classList.add('active');
                else if (idx + 1 < current) circle.classList.add('completed');
            });

            if (stepId === 'step-cat-select') updateCatUiLimits();
            updateMetaSummaryView();
        }

        function setOrderType(type) {
            if (type === 'Delivery') {
                window.location.href = 'delivery.php';
            } else {
                document.getElementById('formOrderType').value = type;
                localStorage.setItem('order_type', type);
                navigateToStep('step-cat-query');
            }
        }

        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const dateInput = document.getElementById('flowDate').value;
            const timeInput = document.getElementById('flowTime').value;
            const bag = JSON.parse(localStorage.getItem('cafe_bag')) || [];

            if (!dateInput || !timeInput) {
                alert('Please provide both a date and arrival time.');
                return;
            }
            if (bag.length === 0) {
                alert('Your bag is empty! Please add some treats before proceeding.');
                return;
            }

            localStorage.setItem('booking_date', dateInput);
            localStorage.setItem('booking_time', timeInput);

            if (chosenCatsArray.length > 0) {
                localStorage.setItem('cat_id', chosenCatsArray[0].id);
                localStorage.setItem('summary_cat_name', chosenCatsArray.map(c => c.name).join(', '));
            } else {
                localStorage.removeItem('cat_id');
                localStorage.removeItem('summary_cat_name');
            }

            window.location.href = 'order_summary.php';
        });
    </script>
</body>

</html>