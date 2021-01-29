<template>
    <div id="main">
        <Menu></Menu>
        	<div class="wrapper">

		<div class="hero">

			<div class="shell">
				<div class="hero__background" ></div><!-- /.hero__background -->

				<div class="hero__inner">
					<figure class="hero__image">
						<img src="assets/images/hero-illustration@2x.png" alt="hero-illustration">
					</figure><!-- /.hero__image -->

					<div class="hero__content">
						<h1>Sell <span>Digital Goods</span> Online </h1>

						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

						<div class="hero__actions">
							<a href="#" class="btn btn--secondary">Get Started</a>
						</div><!-- /.hero__actions -->
						
						<a href="#" class="scroll-btn">
							<img src="assets/images/scroll-button@2x.png" alt="scroll-button" width="25" height="57">
						</a>
					</div><!-- /.hero__content -->
				</div><!-- /.hero__inner -->
			</div><!-- /.shell -->
		</div><!-- /.hero -->
		
		<div class="main" >
			<section class="section">
				<div class="shell">
					<div class="section__head">
						<h2>About us</h2>
					</div><!-- /.section__head -->

					<div class="section__body">
						<figure class="section__image">
							<img src="assets/images/section-illustration@2x.png" alt="section-illustration">
						</figure><!-- /.section__image -->

						<div class="section__content">
							<h2>SatPay</h2>

							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>

							<a href="#" class="btn btn--alt">Learn More</a>
						</div><!-- /.section__content -->
					</div><!-- /.section__body -->
				</div><!-- /.shell -->
			</section><!-- /.section -->

			<section class="section-alt">
				<div class="shell">
					<div class="section__background" ></div><!-- /.section__background -->

					<div class="section__head">
						<h2>Features</h2>
					</div><!-- /.section__head -->

					<div class="section__body">
						<div class="cards">
							<div class="grid">
								<div class="grid__col grid__col--1of3">
									<div class="card">
										<figure class="card__image">
											<img src="assets/images/card-image-1@2x.png" alt="card-image-1" width="88" height="89">
										</figure><!-- /.card__image -->
										
										<div class="card__content">
											<h4>lorem ipsum</h4>

											<p>It is a long established fact that a reader will be distracted by the readable content</p>
										</div><!-- /.card__content -->
									</div><!-- /.card -->
								</div><!-- /.grid__col -->

								<div class="grid__col grid__col--1of3">
									<div class="card">
										<figure class="card__image">
											<img src="assets/images/card-image-2@2x.png" alt="card-image-2" width="124" height="82">
										</figure><!-- /.card__image -->
										
										<div class="card__content">
											<h4>lorem ipsum</h4>

											<p>It is a long established fact that a reader will be distracted by the readable content</p>
										</div><!-- /.card__content -->
									</div><!-- /.card -->
								</div><!-- /.grid__col -->

								<div class="grid__col grid__col--1of3">
									<div class="card">
										<figure class="card__image">
											<img src="assets/images/card-image-3@2x.png" alt="card-image-3" width="104" height="77">
										</figure><!-- /.card__image -->
										
										<div class="card__content">
											<h4>lorem ipsum</h4>

											<p>It is a long established fact that a reader will be distracted by the readable content</p>
										</div><!-- /.card__content -->
									</div><!-- /.card -->
								</div><!-- /.grid__col -->
								
								<div class="grid__col grid__col--1of3">
									<div class="card">
										<figure class="card__image">
											<img src="assets/images/card-image-4@2x.png" alt="card-image-4" width="102" height="91">
										</figure><!-- /.card__image -->
										
										<div class="card__content">
											<h4>lorem ipsum</h4>

											<p>It is a long established fact that a reader will be distracted by the readable content</p>
										</div><!-- /.card__content -->
									</div><!-- /.card -->
								</div><!-- /.grid__col -->

								<div class="grid__col grid__col--1of3">
									<div class="card">
										<figure class="card__image">
											<img src="assets/images/card-image-5@2x.png" alt="card-image-5" width="131" height="131">
										</figure><!-- /.card__image -->
										
										<div class="card__content">
											<h4>lorem ipsum</h4>

											<p>It is a long established fact that a reader will be distracted by the readable content</p>
										</div><!-- /.card__content -->
									</div><!-- /.card -->
								</div><!-- /.grid__col -->

								<div class="grid__col grid__col--1of3">
									<div class="card">
										<figure class="card__image">
											<img src="assets/images/card-image-6@2x.png" alt="card-image-6" width="142" height="95">
										</figure><!-- /.card__image -->
										
										<div class="card__content">
											<h4>lorem ipsum</h4>

											<p>It is a long established fact that a reader will be distracted by the readable content</p>
										</div><!-- /.card__content -->
									</div><!-- /.card -->
								</div><!-- /.grid__col -->
							</div><!-- /.grid -->
						</div><!-- /.cards -->
					</div><!-- /.section__body -->
				</div><!-- /.shell -->
			</section><!-- /.section-alt -->
		</div><!-- /.main -->
        <Footer></Footer>
	</div><!-- /.wrapper -->
    </div>
</template>

<script>
    import Menu from '../../Components/Menu.vue'
    import Footer from '../../Components/Footer.vue'
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        components: {
            Menu,
            Footer
        }
    }
</script>
