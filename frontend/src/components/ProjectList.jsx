import { useState, useEffect, useCallback } from "react";
import {
    getProjects,
    getProjectSummary,
    getProjectTasks,
} from "../api/projects";
import ProjectCard from "./ProjectCard";

export default function ProjectList({ showToast }) {
    const [projects, setProjects] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState("");

    const load = useCallback(async () => {
        setLoading(true);
        setError("");
        try {
            const res = await getProjects();
            const detailed = await Promise.all(
                res.data.data.map(async (p) => {
                    const [sumRes, taskRes] = await Promise.all([
                        getProjectSummary(p.id),
                        getProjectTasks(p.id),
                    ]);
                    return {
                        ...p,
                        summary: sumRes.data,
                        tasks: taskRes.data.data,
                    };
                }),
            );
            setProjects(detailed);
        } catch (e) {
            setError(e.response?.data?.message || "Failed to load projects.");
        } finally {
            setLoading(false);
        }
    }, []);

    useEffect(() => {
        load();
    }, [load]);

    if (loading)
        return (
            <p
                style={{
                    color: "#94a3b8",
                    fontSize: 13,
                    paddingTop: 40,
                    textAlign: "center",
                }}
            >
                Loading projects…
            </p>
        );

    if (error)
        return (
            <div
                style={{
                    background: "#2d100e",
                    border: "1px solid #7f1d1d",
                    color: "#fca5a5",
                    borderRadius: 6,
                    padding: "10px 14px",
                    fontSize: 13,
                }}
            >
                {error}
            </div>
        );

    if (!projects.length)
        return (
            <p style={{ color: "#94a3b8", fontSize: 13 }}>No projects found.</p>
        );

    return (
        <div>
            {projects.map((p) => (
                <ProjectCard
                    key={p.id}
                    project={p}
                    onRefresh={load}
                    showToast={showToast}
                />
            ))}
        </div>
    );
}
