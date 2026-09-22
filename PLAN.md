## 1. Task Breakdown

We’ll follow an Agile Scrum approach.

For story points, we’ll use the Fibonacci scale: 1, 2, 3, 5, 8, 13.

A higher number means the task has more complexity, effort, or uncertainty.

Hour estimates are provided as requested. Without knowing each team member's capacity and project familiarity, actual hours may vary. These can be refine after 1st sprint iteration once clear picture of individual speed.

Using this rough guide:
1 SP = 2 hours
3 SP = 4-6 hours
5 SP = 8-10 hours
8 SP = 12-16 hours
13 SP = 20-24 hours


**Sprint 1 (Week 1) — Foundation**
- Excel data migration and cleanup (Ravi, 8 SP) (12-16 h)
- Laravel setup: auth, roles, migrations, seeders (Ravi, 5 SP) (8-10 h)
- Member profile, membership status, renewal logic (Ravi, 5 SP) (8-10 h)
- Vue setup, login, member portal UI (Aman, 8 SP)  (12-16 h)
- Flutter project scaffolding and dependency setup (Sam, 5SP) (8-10 h)
- Code review and PR feedback for Ravi and Aman (Sam, 3SP) (4-6 h)
- Review API contracts with Ravi to prepare for Flutter integration (Sam, 3SP) (4-6 h)

**Sprint 2 (Week 2) — Core Features**
- Stripe payment and webhook (Ravi, 13 SP) (20-24 h)
- Invoice PDF generation and download (Priya, 8 SP) (12-16 h)
- Email reminders and queue (Priya, 5 SP) (8-10 h)
- Admin dashboard: lapsed members, reminders, CSV export (Priya, 5 SP) (8-10 h)
- Vue: payment flow, invoice download (Aman, 8 SP) (12-16 h)
- Testing the API endpoints that Flutter will consume (Sam, 8SP) (12-16 h)
- Continue Review PR (Sam, 3SP) (4-6 h)
- Navigation setup Flatter (Sam, 5SP) (8-10 h)

**Sprint 3 (Week 3) — Flutter + Polish**
- Flutter: login, profile, membership status (Sam, 13 SP) (20-24 h)
- Bug fixes and demo prep (Ravi + Priya, 5 SP) (8-10 h)
- Final UI pass (Aman, 3 SP)

---

## 2. Who Does What

- **Ravi** — backend lead, Stripe, data migration and API contracts
- **Priya** — invoices, email reminders, admin features
- **Aman** — full Vue frontend, working from Ravi’s API contracts
- **Sam** — Flutter app, week 1 and 2 will be PR review and project scaffolding, starts app in week 3 once API is stable.

---

## 3. Demo vs Phase 2

**Demo includes:**
- Member login and profile
- Membership renewal payment
- Invoice download
- Admin view of lapsed members
- Sending reminders
- CSV export
- Flutter login, profile and membership status (read-only)

**Phase 2:**
- Stripe payments in Flutter app
- Automated scheduled reminders
- Member self-registration workflow

**To the client:** "We'll have all the core member and admin workflows ready for the demo. Mobile payments and automated reminders need more time to get right and we plan to deliver those in phase 2. Nothing that affects for  pre-launch."

---

## 4. Five Questions Before We Start

1. Do you have a Stripe account already, or do we create one?
2. Is there one membership price or multiple tiers?
3. How many reminder emails should be sent, and how long before the renewal date?
4. Can we get the Excel file on day one so we can check the data quality before finalising the story points?
5. Will there be one admin user or multiple staff members? If there are multiple users, do they need different permission levels?

---

## 5. Two Biggest Risks

**Stripe and invoices** — Anything involving payments needs to be handled carefully. Ravi will own this area end-to-end. We’ll test the payment flow using Stripe test mode, and the invoice format will be reviewed and approved by the client before going live.

**Excel data quality** — Member data is often not as clean as expected. We’ll get the Excel file on day one, run an initial validation, and provide the client with a report showing what imported successfully and what needs to be reviewed.

This lets us identify data problems early rather than discovering them later in the project.

---

## 6. How We Run the Week

Daily standup on communcation channel (Teams / Slack) at 10am IST (2:30pm AEST) 

The team will share:
- What they’re working on today
- What they completed yesterday
- Any blockers or issues

At 5pm IST the team posts a quick message on communcation channel (Teams / Slack) - 

- What was completed
- What is still in progress
- Any blockers

I pick it up by 9:30AM AEST. By the time they start next morning the answer is there.

Every Monday a short update goes to the client - what completed, what is next plan, anything we need a decision to ask or business blocker.

Wednesday 11am IST (3:30pm AEST) - 30 min video call for anything that needs a real conversation. Everything else stays on communcation channel (Teams / Slack).