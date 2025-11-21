document.addEventListener("DOMContentLoaded", function () {
    // Cache DOM elements sekali saja
    const elements = {
        skillsGrid: document.getElementById("skillsGrid"),
        projectsSection: document.getElementById("projectsSection"),
        projectsGrid: document.getElementById("projectsGrid"),
        projectsFor: document.getElementById("projectsFor"),
        projectsEmpty: document.getElementById("projectsEmpty"),
        closeBtn: document.getElementById("closeProjects"),
    };

    // // Sample data yang ringan
    // const projectSamples = {
    //     laravel: [
    //         {
    //             title: "API IoT Device Management",
    //             description:
    //                 "API integration for IoT device management and data collection",
    //             url: "#",
    //             code: "https://github.com/prdhk2/API_Integration_IoT-Laravel12",
    //             meta: "Laravel, MySQL",
    //         },
    //         {
    //             title: "Admin Dashboard",
    //             description:
    //                 "Comprehensive admin panel with real-time analytics",
    //             url: "#",
    //             code: "#",
    //             meta: "Laravel, Livewire",
    //         },
    //         {
    //             title: "Blog Platform",
    //             description:
    //                 "Multi-user blogging platform with rich text editing and SEO features",
    //             url: "#",
    //             code: "#",
    //             meta: "Laravel, Vue.js",
    //         },
    //     ],
    //     nodejs: [
    //         {
    //             title: "Realtime Catalog",
    //             description:
    //                 "Product catalog with real-time updates using Socket.io",
    //             url: "#",
    //             code: "#",
    //             meta: "Node.js, Socket.io",
    //         },
    //     ],
    //     codeigneter: [
    //         {
    //             title: 'Toko Online "Bakul Sayur"',
    //             description:
    //                 "Project Toko Online untuk penjualan sayur secara online, Dilengkap dengan API Pyment gateway (Midtrans)",
    //             url: "#",
    //             code: "https://github.com/prdhk2/toko-online-codeigniter3",
    //             meta: "CodeIgniter 3, MySQL ",
    //         },
    //     ],
    //     iot: [],
    // };

    // Utility functions
    const utils = {
        formatTechName: (tech) =>
            tech.replace(/-/g, " ").replace(/\b\w/g, (c) => c.toUpperCase()),

        truncateText: (text, maxLength = 120) =>
            text && text.length > maxLength
                ? text.slice(0, maxLength).trim() + "…"
                : text,

        createProjectCard: (project) => {
            const card = document.createElement("article");
            card.className = "project-card";
            card.innerHTML = `
                <div class="pc-body">
                    <div class="pc-head">
                        <h4 class="pc-title">${project.title}</h4>
                        <div class="pc-meta muted">${project.meta || ""}</div>
                    </div>
                    <p class="pc-desc">${utils.truncateText(
                        project.description
                    )}</p>
                    <div class="pc-links">
                        <a class="view" href="${
                            project.url || "#"
                        }" target="_blank" rel="noopener">View Project</a>
                        ${
                            project.code
                                ? `<a class="code" href="${project.code}" target="_blank" rel="noopener">Source Code</a>`
                                : ""
                        }
                    </div>
                </div>
            `;
            return card;
        },
    };

    // Projects management
    const projectsManager = {
        async loadProjects(tech) {
            const techName = utils.formatTechName(tech);

            // Update UI state
            elements.projectsFor.textContent = techName;
            elements.projectsEmpty.hidden = true;
            elements.projectsGrid.innerHTML = "";

            // Show loading state
            elements.projectsGrid.innerHTML =
                '<div class="loading">Loading projects...</div>';
            elements.projectsSection.hidden = false;

            try {
                // Try to fetch from server first
                const response = await fetch(
                    `/projects?tech=${encodeURIComponent(tech)}`,
                    {
                        headers: {
                            Accept: "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                        },
                        timeout: 5000,
                    }
                );

                let projects = [];

                if (response.ok) {
                    projects = await response.json();
                } else {
                    // Fallback to sample data
                    projects = projectSamples[tech] || [];
                }

                this.renderProjects(projects, techName);
            } catch (error) {
                // console.warn('Using sample data due to:', error.message);
                this.renderProjects(projectSamples[tech] || [], techName);
            }

            // Smooth scroll to projects section
            elements.projectsSection.scrollIntoView({
                behavior: "smooth",
                block: "nearest",
            });
        },

        renderProjects(projects, techName) {
            elements.projectsGrid.innerHTML = "";

            if (!projects || projects.length === 0) {
                elements.projectsEmpty.hidden = false;
                return;
            }

            // Use DocumentFragment for better performance
            const fragment = document.createDocumentFragment();

            projects.forEach((project) => {
                const card = utils.createProjectCard(project);
                fragment.appendChild(card);
            });

            elements.projectsGrid.appendChild(fragment);
        },

        closeProjects() {
            elements.projectsSection.hidden = true;
            // Reset state for next opening
            elements.projectsGrid.innerHTML = "";
            elements.projectsEmpty.hidden = true;
        },
    };

    // Event handlers dengan delegation yang efisien
    const eventHandlers = {
        handleSkillsClick: (e) => {
            const skillBtn = e.target.closest(".skill");
            if (!skillBtn) return;

            const tech = skillBtn.dataset.tech;
            if (tech) {
                projectsManager.loadProjects(tech);
            }
        },

        handleCloseClick: () => {
            projectsManager.closeProjects();
        },

        handleOutsideClick: (e) => {
            if (elements.projectsSection.hidden) return;

            const isClickInsideProjects = elements.projectsSection.contains(
                e.target
            );
            const isClickInsideSkills = elements.skillsGrid.contains(e.target);

            if (!isClickInsideProjects && !isClickInsideSkills) {
                projectsManager.closeProjects();
            }
        },

        handleEscapeKey: (e) => {
            if (e.key === "Escape" && !elements.projectsSection.hidden) {
                projectsManager.closeProjects();
            }
        },
    };

    // Initialize event listeners
    function initEventListeners() {
        // Single event listener untuk semua skill buttons
        elements.skillsGrid.addEventListener(
            "click",
            eventHandlers.handleSkillsClick
        );

        // Close button
        elements.closeBtn.addEventListener(
            "click",
            eventHandlers.handleCloseClick
        );

        // Outside click untuk menutup projects panel
        document.addEventListener("click", eventHandlers.handleOutsideClick);

        // Escape key support
        document.addEventListener("keydown", eventHandlers.handleEscapeKey);
    }

    // Initialize application
    function init() {
        if (!elements.skillsGrid || !elements.projectsSection) {
            // console.warn('Required DOM elements not found');
            return;
        }

        initEventListeners();
        console.log("Portfolio profile initialized");
    }

    // Start the application
    init();
});

const scrollLock = {
    enable() {
        document.body.classList.add("body-no-scroll");
        // Backup untuk mobile
        document.body.style.overflow = "hidden";
        document.documentElement.style.overflow = "hidden";
    },

    disable() {
        document.body.classList.remove("body-no-scroll");
        document.body.style.overflow = "";
        document.documentElement.style.overflow = "";
    },
};

// Dalam projectsManager
const projectsManager = {
    async loadProjects(tech) {
        const techName = utils.formatTechName(tech);

        // Update UI state
        elements.projectsFor.textContent = techName;
        elements.projectsEmpty.hidden = true;
        elements.projectsGrid.innerHTML = "";

        // Show loading state
        elements.projectsGrid.innerHTML =
            '<div class="loading">Loading projects...</div>';
        elements.projectsSection.hidden = false;

        // FIX: Prevent body scroll
        scrollLock.enable();

        try {
            const response = await fetch(
                `/projects?tech=${encodeURIComponent(tech)}`,
                {
                    headers: {
                        Accept: "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                    },
                }
            );

            let projects = [];

            if (response.ok) {
                projects = await response.json();
            } else {
                projects = projectSamples[tech] || [];
            }

            this.renderProjects(projects, techName);
        } catch (error) {
            console.warn("Using sample data due to:", error.message);
            this.renderProjects(projectSamples[tech] || [], techName);
        }

        // Smooth scroll to projects section
        elements.projectsSection.scrollIntoView({
            behavior: "smooth",
            block: "nearest",
        });
    },

    closeProjects() {
        elements.projectsSection.hidden = true;
        elements.projectsGrid.innerHTML = "";
        elements.projectsEmpty.hidden = true;

        // FIX: Restore body scroll
        scrollLock.disable();
    },
};
