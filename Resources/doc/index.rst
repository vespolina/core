Vespolina CartBundle

General Concepts
================

The Cart class is a container for basic cart information. This includes the cart owner, state, items and more.
The minimal data needed for a Cart is the owner, the state and at least one cart item.

The CartItem class is a container for cart item information such as the referenced product or service, quantity,
cart options, and the item state.

The CartOption class holds a information on a chosen cart item option.  For instance, if a t-shirt has options small, medium and large,
the cart item would reference the t-shirt and you would store the chosen size as a cart item option.


Using the VespolinaCartBundle
================================



Configuration reference
=======================

All available configuration options are listed below with their default values:

    # app/config/vespolina.yml
    vespolina_cart:
        db_driver:      ~ # Required (value should be "mongodb" or "orm" - ORM not yet ready for use)
        cart:             # Optional
          class: ~
        cartItem:         # Optional
          class: ~