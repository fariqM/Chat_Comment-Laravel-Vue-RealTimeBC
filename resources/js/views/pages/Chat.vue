<template>
	<div data-sidebar-container="chat" class="card chat-sidebar-container">
		<div  v-bind:style="{left : leftSidebarChat + 'px'}" data-sidebar="chat" class="chat-sidebar-wrap">
			<div class="border-right">
				<div
					class="pt-2 pb-2 pl-3 pr-3 d-flex align-items-center o-hidden box-shadow-1 chat-topbar"
				>
					<a @click="changeleftSidebarChat" data-sidebar-toggle="chat" class="link-icon d-md-none">
						<i class="icon-regular ml-0 mr-3 i-Left"></i>
					</a>
					<div class="form-group m-0 flex-grow-1">
						<input
							v-model="contactSearch"
							type="text"
							class="form-control form-control-rounded"
							id="search"
							placeholder="Search contacts"
						/>
					</div>
				</div>

				<div class="contacts-scrollable perfect-scrollbar">
					<contactscroll :ops="ContactScroll_ops" ref="vs">
						<!-- Recent Chatting -->
						<div
							class="mt-4 pb-2 pl-3 pr-3 font-weight-bold text-muted border-bottom"
						>
							Recent
						</div>

						<template v-for="contact in filteredCOntact">
							<div
								v-if="contact.isChatting"
								:key="contact.messae"
								@click="contactClick(contact)"
								:class="{ online: contact.isActive }"
								class="p-3 d-flex align-items-center border-bottom contact"
							>
								<img
									:src="contact.contact_pict"
									class="avatar-sm rounded-circle mr-3"
									alt=""
								/>
								<div>
									<h6 class="m-0">{{ contact.contact_name }}</h6>
									<span class="text-muted text-small">{{
										contact.last_message_time
									}}</span>
								</div>
							</div>
						</template>

						<!-- End Recent Chatting -->

						<!-- Contact List -->
						<div
							class="mt-3 pb-2 pl-3 pr-3 font-weight-bold text-muted border-bottom"
						>
							Contacts
						</div>

						<template v-for="contact in filteredCOntact">
							<div
								v-if="contact.isChatting === false"
								@click="contactClick(contact)"
								:key="contact.contact_id"
								:class="{ online: contact.isActive }"
								class="p-3 d-flex border-bottom align-items-center contact"
							>
								<img
									v-bind:src="contact.contact_pict"
									alt=""
									class="avatar-sm rounded-circle mr-3"
								/>
								<h6 class="">{{ contact.contact_name }}</h6>
							</div>
						</template>
					</contactscroll>
				</div>
			</div>
		</div>

		<!-- Chat Panel -->
		<div data-sidebar-content="chat" class="chat-content-wrap">
			<template v-if="isClickingCOntact">
				<div
					class="d-flex pl-3 pr-3 pt-2 pb-2 o-hidden box-shadow-1 chat-topbar"
				>
					<a @click="changeleftSidebarChat"  class=" d-md-none">
						<i class="icon-regular i-Right ml-0 mr-3"></i>
					</a>
					<div class="d-flex align-items-center">
						<img
							alt=""
							v-bind:src="current_contact.pict"
							class="avatar-sm rounded-circle mr-2"
						/>
						<p class="m-0 text-title text-16 flex-grow-1">
							{{ current_contact.name }}
						</p>
					</div>
				</div>

				<myScroll :ops="ops" ref="vs">
					<!-- Item Chat Container -->
					<div class="chat-content perfect-scrollbar">
						<div v-for="(item, idx) in histories" :key="idx">
							<div v-if="item.user_id !== current_user_id" class="d-flex mb-4">
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

							<div
								v-if="item.user_id === current_user_id"
								class="d-flex mb-4 user"
							>
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
					</div>
				</myScroll>

				<div class="pl-3 pr-3 pt-3 pb-3 box-shadow-1 chat-input-area">
					<form @submit.prevent="sendMessage">
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
								<i class="i-Paper-Plane"></i>
							</button>
						</div>
					</form>
				</div>
			</template>

			<template v-if="!isClickingCOntact">
				<div class="default-chat">
					<div class="default-chat2">
						<div
							style="background-color: transparent"
							class="d-flex pl-3 pr-3 pt-2 pb-2 o-hidden chat-topbar"
						>
							<a data-sidebar-toggle="chat" class="link-icon d-md-none">
								<i class="icon-regular i-Right ml-0 mr-3"></i>
							</a>
						</div>
					</div>
				</div>
			</template>
		</div>

		<!-- End Chat Panel -->
	</div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import ChatApp from "../../store/chat/ChatStore";
import contactscroll from "vuescroll";

export default {
	components: {
		contactscroll,
	},
	data() {
		return {
			leftSidebarChat: 0,
			isClickingCOntact: false,
			chat: {
				contact_id: 0,
				sender_id: 0,
				user_id: 0,
				message: "",
				file_location: "",
				deleted: false,
				time: "",
			},
			form: {
				message: "",
				file_location: "",
				deleted: false,
			},
			contactSearch: "",
			current_contact: {
				contact_id: 0,
				user_id: 0,
				isChatting: false,
				pict: "",
				name: "",
				last_message_time: "",
				isActive: true,
				converse_id: "",
			},
			current_user_id: 1,
			ContactScroll_ops: {
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
					maxHeight: "100%",
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
					scrollingX: false,
					scrollingY: true,
					speed: 300,
					easing: undefined,
					verticalNativeBarPos: "right",
					maxWidth: "100%",
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
	beforeDestroy() {
		this.$store.unregisterModule("chat");
	},
	computed: {
		...mapGetters({ histories: "chat/getHistory" }),
		...mapGetters({ contacts: "chat/getContacts" }),

		// Search Contact logic
		filteredCOntact: function () {
			// should be
			return this.contacts.filter((contact) => {
				return contact.contact_name.toLowerCase().match(this.contactSearch);
			});
		},
	},
	mounted() {
		this.chatPreloader();
		setTimeout(() => this.scrollDownChat(), 70);
	},
	methods: {
		changeleftSidebarChat(){
			this.leftSidebarChat == -260 ? this.leftSidebarChat = 0 : this.leftSidebarChat = -260 
			console.log(this.leftSidebarChat);
		},
		...mapActions(["chat/setChatHistory"]),
		...mapActions(["chat/setDumpHistory"]),
		getHistories() {
			// get histories from API when clicking the contact
		},

		contactClick(value) {
			this.isClickingCOntact = true;
			this.current_contact.name = value.contact_name;
			this.current_contact.pict = value.contact_pict;
			this.current_contact.user_id = value.user_id;
			this.current_contact.contact_id = value.contact_id;
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
			this.chat.time = s.toLocaleTimeString();
			this.chat.message = this.form.message;
			this.chat.sender_id = this.current_user_id;
			this.chat.user_id = this.current_contact.user_id;
			this.chat.contact_id = this.current_contact.contact_id;

			if (this.chat.message === "") {
				this.$toast.error("please send a text first", "Oops,", {
					position: "topRight",
				});
			} else {
				this["chat/setChatHistory"](this.chat);
				this.form.message = "";
				this.form.file_location = "";
				setTimeout(() => this.scrollDownChat(), 70);
				console.log(this.chat);
			}
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