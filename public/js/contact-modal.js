export class ContactModal {
    constructor(modalId = "contactModal", triggerId = "contactBtn") {
        this.modal = document.getElementById(modalId);
        this.trigger = document.getElementById(triggerId);
        this.closeBtn = this.modal?.querySelector(".contact-modal__close");
        this.backdrop = this.modal?.querySelector(".contact-modal__backdrop");
        this.focusableElements =
            'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
        this.firstFocusableElement = null;
        this.lastFocusableElement = null;

        this.isOpen = false;

        if (this.modal && this.trigger) {
            this.init();
        }
    }

    init() {
        this.bindEvents();
        this.setFocusableElements();
    }

    bindEvents() {
        // Open modal
        this.trigger.addEventListener("click", (e) => {
            e.preventDefault();
            this.open();
        });

        // Close modal
        this.closeBtn.addEventListener("click", () => this.close());
        this.backdrop.addEventListener("click", () => this.close());

        // Close on escape key
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape" && this.isOpen) {
                this.close();
            }

            // Trap focus inside modal when open
            if (e.key === "Tab" && this.isOpen) {
                this.trapFocus(e);
            }
        });

        // Prevent modal content click from closing modal
        this.modal
            .querySelector(".contact-modal__content")
            .addEventListener("click", (e) => {
                e.stopPropagation();
            });
    }

    setFocusableElements() {
        const focusable = this.modal.querySelectorAll(this.focusableElements);
        this.firstFocusableElement = focusable[0];
        this.lastFocusableElement = focusable[focusable.length - 1];
    }

    trapFocus(e) {
        if (e.shiftKey) {
            // Shift + Tab
            if (document.activeElement === this.firstFocusableElement) {
                this.lastFocusableElement.focus();
                e.preventDefault();
            }
        } else {
            // Tab
            if (document.activeElement === this.lastFocusableElement) {
                this.firstFocusableElement.focus();
                e.preventDefault();
            }
        }
    }

    open() {
        this.modal.hidden = false;
        this.modal.setAttribute("aria-hidden", "false"); // FIX: Set to false when open
        this.isOpen = true;
        document.body.classList.add("modal-open");

        // Set focusable elements
        this.setFocusableElements();

        // Focus management for accessibility
        setTimeout(() => {
            this.closeBtn.focus();
        }, 100);

        // Dispatch custom event
        this.modal.dispatchEvent(new CustomEvent("contactModal:open"));
    }

    close() {
        this.modal.hidden = true;
        this.modal.setAttribute("aria-hidden", "true"); // FIX: Set to true when closed
        this.isOpen = false;
        document.body.classList.remove("modal-open");

        // Return focus to trigger button
        this.trigger.focus();

        // Dispatch custom event
        this.modal.dispatchEvent(new CustomEvent("contactModal:close"));
    }

    // Public methods for external control
    show() {
        this.open();
    }

    hide() {
        this.close();
    }

    // Destroy method for cleanup
    destroy() {
        this.close();
    }
}

// Auto-initialize
if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", () => {
        new ContactModal();
    });
} else {
    new ContactModal();
}
