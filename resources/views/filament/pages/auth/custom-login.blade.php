<div class="login-container min-h-screen w-full flex items-center justify-center px-4 py-8">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        .login-container {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #fff7d1 0%, #ffe9a4 100%);
        }

        .fi-simple-main {
            max-width: 100% !important;
            margin-block: 0 !important;
            background-color: transparent !important;
        }

        .login-card {
            background: white;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
            border-radius: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 48px rgba(255, 193, 7, 0.3);
        }

        .accent-line {
            height: 3px;
            background: linear-gradient(90deg, #ffc107 0%, #ffb300 100%);
            border-radius: 9999px;
        }

        .input-field {
            transition: all 0.25s ease;
            border: 2px solid #e5e7eb;
            background-color: #ffffff;
        }

        .input-field:focus {
            outline: none;
            border-color: #ffc107;
            box-shadow: 0 0 0 4px rgba(255, 193, 7, 0.22);
        }

        .btn-primary {
            background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 8px 18px rgba(255, 193, 7, 0.35);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 26px rgba(255, 193, 7, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .checkbox-custom {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #d1d5db;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .checkbox-custom:checked {
            background-color: #ffc107;
            border-color: #ffc107;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='white'%3E%3Cpath d='M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z'/%3E%3C/svg%3E");
            background-position: center;
            background-repeat: no-repeat;
        }

        .captcha-box {
            background: linear-gradient(135deg, rgba(255, 193, 7, 0.12) 0%, rgba(255, 193, 7, 0.32) 100%);
            border: 2px dashed rgba(255, 193, 7, 0.65);
            letter-spacing: 0.4rem;
        }

        .refresh-btn {
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .refresh-btn:hover {
            transform: rotate(-30deg) scale(1.05);
            color: #ffb300;
        }

        .logo-container {
            animation: fadeInDown 0.6s ease-out;
        }

        .form-animate {
            animation: fadeInUp 0.6s ease-out 0.15s both;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="login-card w-full max-w-md p-10 form-animate">
        <div class="logo-container text-center mb-8">
            <img src="{{ asset('images/logo_bapeten.png') }}" alt="BAPETEN Logo" class="mx-auto mb-4"
                style="width: 80px; height: auto;">
            <h1 class="text-3xl font-bold mb-2 text-[#ffc107]">SIMKA BAPETEN</h1>
            <p class="text-sm font-medium text-gray-500">Sistem Informasi Manajemen Kepegawaian</p>
            <div class="accent-line w-24 mx-auto mt-4"></div>
        </div>

        <form class="space-y-6" x-data="captchaForm()" x-init="refreshCaptcha()" x-on:submit.prevent="handleSubmit">
            <div>
                <label for="email" class="block text-sm font-semibold mb-2 text-gray-700">Email Address</label>
                <input type="email" wire:model="data.email" id="email"
                    class="input-field w-full px-4 py-3 rounded-lg text-sm @error('data.email') border-red-500 @enderror"
                    placeholder="nama@bapeten.go.id" autofocus>
                @error('data.email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div x-data="{ show: false }">
                <label for="password" class="block text-sm font-semibold mb-2 text-gray-700">Password</label>
                <div class="relative">
                    <input :type="show ? 'text' : 'password'" wire:model="data.password" id="password"
                        class="input-field w-full px-4 py-3 rounded-lg text-sm pr-12 @error('data.password') border-red-500 @enderror"
                        placeholder="Masukkan password">
                    <button type="button" @click="show = !show"
                        class="absolute right-3 top-1/2 -translate-y-1/2 p-2 text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg x-show="!show" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd"
                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <svg x-show="show" width="20" height="20" viewBox="0 0 20 20" fill="currentColor"
                            style="display: none;">
                            <path fill-rule="evenodd"
                                d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                                clip-rule="evenodd" />
                            <path
                                d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                        </svg>
                    </button>
                </div>
                @error('data.password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="captcha" class="block text-sm font-semibold mb-2 text-gray-700">Masukkan Captcha</label>
                <div class="flex items-center gap-3 mb-3">
                    <div class="captcha-box flex-1 px-4 py-3 rounded-lg text-2xl font-bold text-[#cc9a00] text-center"
                        x-text="captcha"></div>
                    <button type="button"
                        class="refresh-btn flex h-11 w-11 items-center justify-center rounded-lg border border-amber-200 text-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-200"
                        title="Muat ulang captcha" @click="refreshCaptcha()">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M17.65 6.35A7.958 7.958 0 0012 4a8 8 0 105.65 13.65l1.7 1.7a1 1 0 001.7-.7V13a1 1 0 00-1-1h-5.65a1 1 0 00-.7 1.7l1.73 1.73A6 6 0 1112 6a5.96 5.96 0 014.22 1.78l1.36-1.43a1 1 0 000-1.43z" />
                        </svg>
                    </button>
                </div>
                <input type="text" id="captcha" name="captcha_input"
                    class="input-field w-full px-4 py-3 rounded-lg text-sm"
                    :class="error ? 'border-red-500 ring-red-200 ring-2' : ''" placeholder="Ketik ulang kode captcha"
                    x-model="captchaInput" x-ref="captchaField">
                <template x-if="error">
                    <p class="text-red-500 text-xs mt-2" x-text="error"></p>
                </template>
            </div>

            <div class="flex items-center">
                <input type="checkbox" wire:model="data.remember" id="remember" class="checkbox-custom">
                <label for="remember" class="ml-3 text-sm font-medium text-gray-600 cursor-pointer select-none">
                    Ingat saya
                </label>
            </div>

            <button type="submit" wire:loading.attr="disabled"
                class="btn-primary w-full py-3 rounded-lg text-white font-semibold text-sm disabled:opacity-70 disabled:cursor-not-allowed flex justify-center items-center">
                <span wire:loading.remove>Sign In</span>
                <span wire:loading class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    Memproses...
                </span>
            </button>
        </form>

        <div class="mt-8 text-center">
            <p class="text-xs text-gray-400">© 2026 BAPETEN. All rights reserved.</p>
        </div>
    </div>

    @livewire('notifications')
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('captchaForm', () => ({
            captcha: '',
            captchaInput: '',
            error: null,
            chars: 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789',
            generateCaptcha() {
                let value = '';
                for (let index = 0; index < 5; index += 1) {
                    value += this.chars.charAt(Math.floor(Math.random() * this.chars.length));
                }
                return value;
            },
            refreshCaptcha() {
                this.captcha = this.generateCaptcha();
                this.captchaInput = '';
                this.error = null;
                this.$nextTick(() => this.$refs.captchaField?.focus());
            },
            handleSubmit() {
                if (this.captchaInput.trim().toUpperCase() !== this.captcha) {
                    this.error = 'Kode captcha tidak sesuai.';
                    return;
                }

                this.error = null;

                Promise.resolve(this.$wire.authenticate())
                    .then(() => this.refreshCaptcha());
            },
        }));
    });
</script>
