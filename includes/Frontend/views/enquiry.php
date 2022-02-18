<div class="faisal-enquiry-form" id="faisal-enquiry-form">

    <form action="" method="post">

        <div class="form-row">
            <label for="name"><?php _e( 'Name', 'faisal-academy' ); ?></label>

            <input type="text" id="name" name="name" value="" required>
        </div>

        <div class="form-row">
            <label for="email"><?php _e( 'E-Mail', 'faisal-academy' ); ?></label>

            <input type="email" id="email" name="email" value="" required>
        </div>

        <div class="form-row">
            <label for="message"><?php _e( 'Message', 'faisal-academy' ); ?></label>

            <textarea name="message" id="message" required></textarea>
        </div>

        <div class="form-row">

            <?php wp_nonce_field( 'faisal-ac-enquiry-form-nonce' ); ?>

            <input type="hidden" name="action" value="faisal_academy_enquiry_action">
            <input type="submit" name="send_enquiry" value="<?php esc_attr_e( 'Send Enquiry', 'faisal-academy' ); ?>">
        </div>

    </form>
</div>