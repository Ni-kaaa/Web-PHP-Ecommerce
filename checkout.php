<main class="main">
  <div class="page-content">
    <div class="checkout">
      <div class="container">
        <form action="#">
          <div class="row">
            <div class="col-lg-9">
              <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
              <div class="row">
                <div class="col-sm-6">
                  <label>First Name *</label>
                  <input type="text" class="form-control" required>
                </div><!-- End .col-sm-6 -->

                <div class="col-sm-6">
                  <label>Last Name *</label>
                  <input type="text" class="form-control" required>
                </div><!-- End .col-sm-6 -->
              </div><!-- End .row -->

              <label>Company Name (Optional)</label>
              <input type="text" class="form-control">

              <label>Country *</label>
              <input type="text" class="form-control" required>

              <label>Street address *</label>
              <input type="text" class="form-control" placeholder="House number and Street name" required>
              <input type="text" class="form-control" placeholder="Appartments, suite, unit etc ..." required>

              <div class="row">
                <div class="col-sm-6">
                  <label>Town / City *</label>
                  <input type="text" class="form-control" required>
                </div><!-- End .col-sm-6 -->

                <div class="col-sm-6">
                  <label>State / County *</label>
                  <input type="text" class="form-control" required>
                </div><!-- End .col-sm-6 -->
              </div><!-- End .row -->

              <div class="row">
                <div class="col-sm-6">
                  <label>Postcode / ZIP *</label>
                  <input type="text" class="form-control" required>
                </div><!-- End .col-sm-6 -->

                <div class="col-sm-6">
                  <label>Phone *</label>
                  <input type="tel" class="form-control" required>
                </div><!-- End .col-sm-6 -->
              </div><!-- End .row -->

              <label>Email address *</label>
              <input type="email" class="form-control" required>
              <label>Order notes (optional)</label>
              <textarea class="form-control" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
            </div><!-- End .col-lg-9 -->
            <aside class="col-lg-3">
              <div class="summary">
                <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

                <table class="table table-summary">
                  <thead>
                    <tr>
                      <th>Product</th>
                      <th>Total</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td><a href="#">Beige knitted elastic runner shoes</a></td>
                      <td>$84.00</td>
                    </tr>

                    <tr>
                      <td><a href="#">Blue utility pinafore denimdress</a></td>
                      <td>$76,00</td>
                    </tr>
                    <tr class="summary-subtotal">
                      <td>Subtotal:</td>
                      <td>$160.00</td>
                    </tr><!-- End .summary-subtotal -->
                    <tr>
                      <td>Shipping:</td>
                      <td>Free shipping</td>
                    </tr>
                    <tr class="summary-total">
                      <td>Total:</td>
                      <td>$160.00</td>
                    </tr><!-- End .summary-total -->
                  </tbody>
                </table><!-- End .table table-summary -->

                <div class="accordion-summary" id="accordion-payment">
                  <div class="card">
                    <div class="card-header" id="heading-1">
                      <h2 class="card-title">
                        <a role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                          ABA Payway
                        </a>
                      </h2>
                    </div><!-- End .card-header -->
                    <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#accordion-payment">
                      <div class="card-body">
                        Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                      </div><!-- End .card-body -->
                    </div><!-- End .collapse -->
                  </div><!-- End .card -->

                  <div class="card">
                    <div class="card-header" id="heading-3">
                      <h2 class="card-title">
                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                          Cash on delivery
                        </a>
                      </h2>
                    </div><!-- End .card-header -->
                    <div id="collapse-3" class="collapse" aria-labelledby="heading-3" data-parent="#accordion-payment">
                      <div class="card-body">Quisque volutpat mattis eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.
                      </div><!-- End .card-body -->
                    </div><!-- End .collapse -->
                  </div><!-- End .card -->
                  <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                    <span class="btn-text">Place Order</span>
                    <span class="btn-hover-text">Proceed to Checkout</span>
                  </button>
                </div><!-- End .summary -->
            </aside><!-- End .col-lg-3 -->
          </div><!-- End .row -->
        </form>
      </div><!-- End .container -->
    </div><!-- End .checkout -->
  </div><!-- End .page-content -->
</main><!-- End .main -->