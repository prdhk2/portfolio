class PageLoader {
    constructor() {
        this.loader = document.getElementById("pageLoader");
        this.minDisplayTime = 800; // Minimum display time in ms
        this.startTime = Date.now();

        this.init();
    }

    init() {
        // Hide loader when page is fully loaded
        window.addEventListener("load", () => {
            this.hide();
        });

        // Fallback: hide after max time
        setTimeout(() => {
            this.hide();
        }, 3000);
    }

    hide() {
        const elapsedTime = Date.now() - this.startTime;
        const remainingTime = Math.max(0, this.minDisplayTime - elapsedTime);

        setTimeout(() => {
            this.loader.classList.add("hidden");

            // Remove from DOM after animation
            setTimeout(() => {
                if (this.loader.parentNode) {
                    this.loader.parentNode.removeChild(this.loader);
                }
            }, 500);
        }, remainingTime);
    }

    // Method to show loader manually (for AJAX etc.)
    show() {
        if (!this.loader.parentNode) {
            document.body.appendChild(this.loader);
        }
        this.loader.classList.remove("hidden");
        this.startTime = Date.now();
    }
}

// Initialize page loader
document.addEventListener("DOMContentLoaded", () => {
    window.pageLoader = new PageLoader();
});
