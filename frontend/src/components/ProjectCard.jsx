import { useState } from "react";
import TaskRow from "./TaskRow";

const BADGE = {
    active: { bg: "#16503622", color: "#22c55e", border: "#16503633" },
    on_hold: { bg: "#44330022", color: "#f59e0b", border: "#55440033" },
    completed: { bg: "#1e2f5e55", color: "#4f7cff", border: "#1e2f5e" },
};

export default function ProjectCard({ project, onRefresh, showToast }) {
    const [open, setOpen] = useState(false);
    const { summary, tasks } = project;
    const pct =
        summary.total_tasks > 0
            ? Math.round((summary.done_tasks / summary.total_tasks) * 100)
            : 0;
    const badge = BADGE[project.status] || BADGE.active;

    return (
        <div
            style={{
                background: "#181c27",
                border: "1px solid #2a2f3f",
                borderRadius: 8,
                marginBottom: 14,
                overflow: "hidden",
            }}
        >
            <div
                onClick={() => setOpen((o) => !o)}
                style={{
                    display: "flex",
                    alignItems: "center",
                    justifyContent: "space-between",
                    padding: "14px 20px",
                    cursor: "pointer",
                    gap: 12,
                    flexWrap: "wrap",
                }}
            >
                <div>
                    <div
                        style={{
                            fontSize: 15,
                            fontWeight: 600,
                            color: "#e2e8f0",
                        }}
                    >
                        {project.project_name}
                    </div>
                    <div
                        style={{ fontSize: 12, color: "#94a3b8", marginTop: 2 }}
                    >
                        {project.client_name} · Due {project.deadline}
                        {summary.is_project_overdue && (
                            <span
                                style={{
                                    marginLeft: 8,
                                    fontSize: 11,
                                    color: "#ef4444",
                                    background: "#2d100e44",
                                    border: "1px solid #7f1d1d44",
                                    padding: "1px 6px",
                                    borderRadius: 999,
                                }}
                            >
                                overdue
                            </span>
                        )}
                    </div>
                </div>
                <div style={{ display: "flex", alignItems: "center", gap: 10 }}>
                    <span
                        style={{
                            background: badge.bg,
                            color: badge.color,
                            border: `1px solid ${badge.border}`,
                            padding: "2px 10px",
                            borderRadius: 999,
                            fontSize: 11,
                            fontWeight: 500,
                        }}
                    >
                        {project.status.replace("_", " ")}
                    </span>
                    <span
                        style={{
                            fontSize: 11,
                            color: "#6b7280",
                            display: "inline-block",
                            transform: open ? "rotate(180deg)" : "none",
                            transition: "transform .2s",
                        }}
                    >
                        ▼
                    </span>
                </div>
            </div>

            {open && (
                <div>
                    <div
                        style={{
                            padding: "12px 20px 16px",
                            borderTop: "1px solid #2a2f3f",
                            background: "#12151f",
                        }}
                    >
                        <div
                            style={{
                                height: 3,
                                background: "#2a2f3f",
                                borderRadius: 2,
                                marginBottom: 14,
                                overflow: "hidden",
                            }}
                        >
                            <div
                                style={{
                                    height: "100%",
                                    width: `${pct}%`,
                                    background: "#4f7cff",
                                    borderRadius: 2,
                                    transition: "width .4s",
                                }}
                            />
                        </div>
                        <div
                            style={{
                                display: "flex",
                                gap: 24,
                                flexWrap: "wrap",
                            }}
                        >
                            {[
                                {
                                    label: "total tasks",
                                    value: summary.total_tasks,
                                    color: "#e2e8f0",
                                },
                                {
                                    label: "done",
                                    value: summary.done_tasks,
                                    color: "#22c55e",
                                },
                                {
                                    label: "pending",
                                    value: summary.pending_tasks,
                                    color: "#f59e0b",
                                },
                                {
                                    label: "estimated",
                                    value: `${summary.total_estimated_hours}h`,
                                    color: "#4f7cff",
                                },
                                {
                                    label: "remaining",
                                    value: `${summary.hours_remaining}h`,
                                    color:
                                        summary.hours_remaining > 0
                                            ? "#f59e0b"
                                            : "#22c55e",
                                },
                                summary.overdue_tasks > 0 && {
                                    label: "overdue tasks",
                                    value: summary.overdue_tasks,
                                    color: "#ef4444",
                                },
                            ]
                                .filter(Boolean)
                                .map((s) => (
                                    <div key={s.label}>
                                        <div
                                            style={{
                                                fontSize: 18,
                                                fontWeight: 600,
                                                color: s.color,
                                                lineHeight: 1,
                                            }}
                                        >
                                            {s.value}
                                        </div>
                                        <div
                                            style={{
                                                fontSize: 11,
                                                color: "#94a3b8",
                                                marginTop: 2,
                                            }}
                                        >
                                            {s.label}
                                        </div>
                                    </div>
                                ))}
                        </div>
                    </div>

                    <div style={{ padding: "0 20px 20px" }}>
                        {!tasks.length ? (
                            <p
                                style={{
                                    color: "#94a3b8",
                                    fontSize: 13,
                                    paddingTop: 16,
                                }}
                            >
                                No tasks yet.
                            </p>
                        ) : (
                            <table
                                style={{
                                    width: "100%",
                                    borderCollapse: "collapse",
                                }}
                            >
                                <thead>
                                    <tr>
                                        {[
                                            "Task",
                                            "Assignee",
                                            "Due",
                                            "Status",
                                        ].map((h) => (
                                            <th
                                                key={h}
                                                style={{
                                                    textAlign: "left",
                                                    fontSize: 11,
                                                    color: "#94a3b8",
                                                    padding: "10px 0 6px",
                                                    borderBottom:
                                                        "1px solid #2a2f3f",
                                                    fontWeight: 500,
                                                }}
                                            >
                                                {h}
                                            </th>
                                        ))}
                                    </tr>
                                </thead>
                                <tbody>
                                    {tasks.map((task) => (
                                        <TaskRow
                                            key={task.id}
                                            task={task}
                                            projectId={project.id}
                                            onUpdated={onRefresh}
                                            showToast={showToast}
                                        />
                                    ))}
                                </tbody>
                            </table>
                        )}
                    </div>
                </div>
            )}
        </div>
    );
}
