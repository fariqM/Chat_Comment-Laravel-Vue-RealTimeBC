<template>
	<div data-sidebar-container="chat" class="card chat-sidebar-container">
		<div data-sidebar="chat" class="chat-sidebar-wrap">
			<div class="border-right">
				<div
					class="pt-2 pb-2 pl-3 pr-3 d-flex align-items-center o-hidden box-shadow-1 chat-topbar"
				>
					<a data-sidebar-toggle="chat" class="link-icon d-md-none">
						<i class="icon-regular ml-0 mr-3 i-Left"></i>
					</a>
					<div class="form-group m-0 flex-grow-1">
						<input
							type="text"
							class="form-control form-control-rounded"
							id="search"
							placeholder="Search contacts"
						/>
					</div>
				</div>

				<div class="contacts-scrollable perfect-scrollbar">
					<div
						class="mt-4 pb-2 pl-3 pr-3 font-weight-bold text-muted border-bottom"
					>
						Recent
					</div>

					<div
						class="p-3 d-flex align-items-center border-bottom online contact"
					>
						<img
							:src="'/assets/images/faces/13.jpg'"
							class="avatar-sm rounded-circle mr-3"
							alt=""
						/>
						<div>
							<h6 class="m-0">William Wills</h6>
							<span class="text-muted text-small">3 Oct, 2018</span>
						</div>
					</div>

					<div
						class="mt-3 pb-2 pl-3 pr-3 font-weight-bold text-muted border-bottom"
					>
						Contacts
					</div>
					<div
						class="p-3 d-flex border-bottom align-items-center contact online"
					>
						<img
							:src="'/assets/images/faces/13.jpg'"
							alt=""
							class="avatar-sm rounded-circle mr-3"
						/>
						<h6 class="">Jhone Will</h6>
					</div>
					<div
						class="p-3 d-flex border-bottom align-items-center contact online"
					>
						<img
							:src="'/assets/images/faces/13.jpg'"
							alt=""
							class="avatar-sm rounded-circle mr-3"
						/>
						<h6 class="">Jhone Will</h6>
					</div>
					<div class="p-3 d-flex border-bottom align-items-center contact">
						<img
							:src="'/assets/images/faces/13.jpg'"
							alt=""
							class="avatar-sm rounded-circle mr-3"
						/>
						<h6 class="">Jhone Will</h6>
					</div>
				</div>
			</div>
		</div>
		<div data-sidebar-content="chat" class="chat-content-wrap">
			<div class="d-flex pl-3 pr-3 pt-2 pb-2 o-hidden box-shadow-1 chat-topbar">
				<a data-sidebar-toggle="chat" class="link-icon d-md-none">
					<i class="icon-regular i-Right ml-0 mr-3"></i>
				</a>
				<div class="d-flex align-items-center">
					<img
						:src="'/assets/images/faces/13.jpg'"
						alt=""
						class="avatar-sm rounded-circle mr-2"
					/>
					<p class="m-0 text-title text-16 flex-grow-1">Frank Powell</p>
				</div>
			</div>

			<div class="chat-content perfect-scrollbar" data-suppress-scroll-x="true">
				<myScroll :ops="ops" ref="vs">
					<div
						v-for="(item, idx) in history"
						:key="idx"
						class="costume-container-chat-item"
					>
						<!-- Your Chat -->
						<div v-if="item.user_id == current_user_id" class="d-flex mb-4">
							<div class="message flex-grow-1">
								<div class="d-flex">
									<p class="mb-1 text-title text-16 flex-grow-1">
										{{ item.user_name }}
									</p>
									<span class="text-small text-muted"> {{ item.time }} </span>
								</div>
								<p class="m-0">
									{{ item.message }}
								</p>
							</div>
							<img
								:src="'/assets/images/faces/13.jpg'"
								alt=""
								class="avatar-sm rounded-circle ml-3"
							/>
						</div>

						<!-- Someone else Chat -->
						<div v-else class="d-flex mb-4 user">
							<img
								:src="'/assets/images/faces/1.jpg'"
								alt=""
								class="avatar-sm rounded-circle mr-3"
							/>
							<div class="message flex-grow-1">
								<div class="d-flex">
									<p class="mb-1 text-title text-16 flex-grow-1">
										{{ item.user_name }}
									</p>
									<span class="text-small text-muted">{{ item.time }}</span>
								</div>
								<p class="m-0">{{ item.message }}.</p>
							</div>
						</div>
					</div>
				</myScroll>
			</div>

			<div class="card">
				<div class="pl-3 pr-3 pt-3 pb-3 box-shadow-1 chat-input-area">
					<form @submit.prevent="sendMessage" class="inputForm">
						<div class="form-group">
							<textarea
								v-model="form.message"
								class="form-control form-control-rounded"
								placeholder="Type your message"
								name="message"
								id="message"
								cols="30"
								rows="3"
							></textarea>
						</div>
						<div class="d-flex">
							<div class="flex-grow-1"></div>
							<button class="btn btn-icon btn-rounded btn-primary mr-2">
								<i class="i-Paper-Plane"></i>
							</button>
							<button
								class="btn btn-icon btn-rounded btn-outline-primary"
								type="button"
							>
								<i class="i-Add-File"></i>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
// <script script>
// import "../../../../../public/assets/js/sidebar.script.js";
// import "../../../../public/assets/js/sidebar.script.js";
import ChatApp from "../../store/chat/ChatStore";

export default {
	data() {
		return {
			form: {
				user_id: 1,
				user_name: "Cak Mad",
				message: "",
				time: "",
			},
			history: [],
			current_user_id: 1,
			items: [
				{
					log_id: 1,
					username: "Cak Dul",
					last_message: "Apek bozz",
					last_message_time: "22 minutes ago",
					history: [
						{
							user_id: 1,
							user_name: "Cak Mad",
							message: "sembarang wes asdasdasdjkasjdkajskdjkj",
							time: "28 minutes ago",
						},
						{
							user_id: 2,
							user_name: "Cak Dul",
							message: "asdasdasdasd",
							time: "26 minutes ago",
						},
						{
							user_id: 1,
							user_name: "Cak Mad",
							message: "hallo cak piye kabare",
							time: "24 minutes ago",
						},
						{
							user_id: 2,
							user_name: "Cak Dul",
							message: "Apek bozz",
							time: "22 minutes ago",
						},
					],
				},
			],
			ops: {
				vuescroll: {
					mode: "native",
					sizeStrategy: "percent",
					detectResize: false,
					/** Enable locking to the main axis if user moves only slightly on one of them at start */
					locking: false,
				},
				scrollPanel: {
					initialScrollY: false,
					initialScrollX: false,
					scrollingX: true,
					scrollingY: true,
					speed: 300,
					easing: undefined,
					verticalNativeBarPos: "right",
					maxHeight: 250,
				},
				rail: {
					background: "#662489",
					opacity: 0,
					size: "6px",
					specifyBorderRadius: false,
					gutterOfEnds: null,
					gutterOfSide: "2px",
					keepShow: false,
				},
				bar: {
					showDelay: 500,
					onlyShowBarOnScroll: false,
					keepShow: false,
					background: "#662489",
					opacity: 1,
					hoverStyle: false,
					specifyBorderRadius: false,
					minSize: 0,
					size: "6px",
					disable: false,
				},
			},
		};
	},
	created() {
		this.$store.registerModule("chat", ChatApp);
	},
	computed: {
		histories() {
			return this.$store.getters["chat/getHistory"];
		},
	},
	mounted() {
		this.chatPreloader();
		setTimeout(() => this.scrollDownChat(), 70);
		this.getHistories();
	},
	methods: {
		getHistories() {
			this.history = this.$store.getters['chat/getHistory'];
		},
		scrollDownChat() {
			this.$refs["vs"].scrollTo(
				{
					y: "110%",
				},
				500,
				"easeInOutQuart"
			);
		},
		sendMessage() {
			let s = new Date();
			const messages = {
				user_id: 1,
				user_name: "Cak Mad",
				message: "",
				time: "",
			};
			messages.time = s.toLocaleTimeString();
			messages.message = this.form.message;
			this.$store.dispatch("chat/setChatHistory", messages)
			this.form.message = "";
			setTimeout(() => this.scrollDownChat(), 70);
		},
		chatPreloader() {
			window.gullUtils = {
				isMobile: function isMobile() {
					return window && window.matchMedia("(max-width: 767px)").matches;
				},
				changeCssLink: function changeCssLink(storageKey, fileUrl) {
					localStorage.setItem(storageKey, fileUrl);
					location.reload();
				},
			};

			var $sidebarContainer = $("[data-sidebar-container]").addClass(
				"sidebar-container"
			);
			var $sidebarContent = $("[data-sidebar-content]").addClass(
				"sidebar-content"
			);
			var $sidebar = $("[data-sidebar]").addClass("sidebar");

			$sidebarContainer.each(function (index) {
				var $container = $(this);
				var sidebarName;
				var $content;
				var $sb;
				var $toggle;
				var sidebarWidth;
				var sidebarPosition;

				function initSidebar() {
					sidebarName = $container.data("sidebar-container");
					$content = $('[data-sidebar-content="' + sidebarName + '"]');
					$sb = $('[data-sidebar="' + sidebarName + '"]');
					$toggle = $('[data-sidebar-toggle="' + sidebarName + '"]');
					sidebarWidth = $sb.outerWidth();
					sidebarPosition = $sb.data("sidebar-position");
					// console.log("width:: ", $sb);

					if (sidebarPosition === "right") {
						!gullUtils.isMobile()
							? $content.css("margin-right", sidebarWidth)
							: $content.css("margin-right", 0);
						!gullUtils.isMobile()
							? $sb.css("right", 0)
							: $sb.css("right", -sidebarWidth);
					} else {
						// console.log('width: ', sidebarWidth)
						!gullUtils.isMobile()
							? $content.css("margin-left", sidebarWidth)
							: $content.css("margin-left", 0);
						!gullUtils.isMobile()
							? $sb.css("left", 0)
							: $sb.css("left", -sidebarWidth);
					}
				}

				initSidebar();
				$(window).on("resize", function (event) {
					setTimeout(function () {
						initSidebar();
					}, 300);
				});

				$toggle.on("click", function (e) {
					if (sidebarPosition === "right") {
						if ($sb.css("right") == "0px") {
							$sb.css("right", -sidebarWidth);
							!gullUtils.isMobile() ? $content.css("margin-right", 0) : null;
						} else {
							$sb.css("right", 0);
							!gullUtils.isMobile()
								? $content.css("margin-right", sidebarWidth)
								: null;
						}
					} else {
						if ($sb.css("left") == "0px") {
							$sb.css("left", -sidebarWidth);
							!gullUtils.isMobile() ? $content.css("margin-left", 0) : null;
						} else {
							$sb.css("left", 0);
							!gullUtils.isMobile()
								? $content.css("margin-left", sidebarWidth)
								: null;
						}
					}
				});
			});
		},
	},
};
</script>

<style>
</style>