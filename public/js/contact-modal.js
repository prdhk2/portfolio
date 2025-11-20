// public/js/contact-modal.js
export class ContactModal {
    constructor(modalId = 'contactModal', triggerId = 'contactBtn') {
        this.modal = document.getElementById(modalId);
        this.trigger = document.getElementById(triggerId);
        this.closeBtn = this.modal?.querySelector('.contact-modal__close');
        this.backdrop = this.modal?.querySelector('.contact-modal__backdrop');
        
        this.isOpen = false;
        
        if (this.modal && this.trigger) {
            this.init();
        }
    }
    
    init() {
        this.bindEvents();
    }
    
    bindEvents() {
        // Open modal
        this.trigger.addEventListener('click', (e) => {
            e.preventDefault();
            this.open();
        });
        
        // Close modal
        this.closeBtn.addEventListener('click', () => this.close());
        this.backdrop.addEventListener('click', () => this.close());
        
        // Close on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isOpen) {
                this.close();
            }
        });
        
        // Prevent modal content click from closing modal
        this.modal.querySelector('.contact-modal__content').addEventListener('click', (e) => {
            e.stopPropagation();
        });
    }
    
    open() {
        this.modal.hidden = false;
        this.isOpen = true;
        document.body.classList.add('modal-open');
        
        // Focus management for accessibility
        setTimeout(() => {
            this.closeBtn.focus();
        }, 100);
        
        // Dispatch custom event
        this.modal.dispatchEvent(new CustomEvent('contactModal:open'));
    }
    
    close() {
        this.modal.hidden = true;
        this.isOpen = false;
        document.body.classList.remove('modal-open');
        
        // Return focus to trigger button
        this.trigger.focus();
        
        // Dispatch custom event
        this.modal.dispatchEvent(new CustomEvent('contactModal:close'));
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
        // Remove event listeners if needed
    }
}

// Auto-initialize if script is included directly
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        new ContactModal();
    });
} else {
    new ContactModal();
}