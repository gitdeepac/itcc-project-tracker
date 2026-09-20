import { useState } from "react";
import LoginPage from "./components/LoginPage";
import ProjectList from "./components/ProjectList";
import Toast from "./components/Toast";
import { useToast } from "./hooks/useToast";
import { logout } from "./api/projects";

export default function App() {
    const [user, setUser] = useState(() =>
        localStorage.getItem("itcc_token") ? { name: "User" } : null,
    );
    const { toast, showToast } = useToast();

    async function handleLogout() {
        try {
            await logout();
        } catch (_) {}
        localStorage.removeItem("itcc_token");
        setUser(null);
    }

    if (!user)
        return (
            <>
                <LoginPage onLogin={setUser} />
                <Toast toast={toast} />
            </>
        );

    return (
        <div
            style={{
                background: "#0f1117",
                minHeight: "100vh",
                fontFamily: "system-ui, sans-serif",
            }}
        >
            <div
                style={{
                    maxWidth: 960,
                    margin: "0 auto",
                    padding: "32px 20px 60px",
                }}
            >
                <div
                    style={{
                        display: "flex",
                        justifyContent: "space-between",
                        alignItems: "center",
                        marginBottom: 32,
                    }}
                >
                    <div
                        style={{
                            fontSize: 20,
                            fontWeight: 600,
                            color: "#e2e8f0",
                        }}
                    >
                        ITCC{" "}
                        <span style={{ color: "#4f7cff" }}>
                            Project Tracker
                        </span>
                    </div>
                    <div
                        style={{
                            display: "flex",
                            alignItems: "center",
                            gap: 10,
                        }}
                    >
                        <span
                            style={{
                                background: "#1e2f5e",
                                color: "#4f7cff",
                                padding: "3px 10px",
                                borderRadius: 999,
                                fontSize: 11,
                            }}
                        >
                            {user.name}
                        </span>
                        <button
                            onClick={handleLogout}
                            style={{
                                background: "transparent",
                                border: "1px solid #2a2f3f",
                                color: "#94a3b8",
                                borderRadius: 6,
                                padding: "5px 12px",
                                fontSize: 12,
                                cursor: "pointer",
                            }}
                        >
                            Sign out
                        </button>
                    </div>
                </div>
                <ProjectList showToast={showToast} />
            </div>
            <Toast toast={toast} />
        </div>
    );
}
