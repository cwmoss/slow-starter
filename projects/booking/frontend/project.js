import previews from "./previews.js";
import { edit_node, type_node, node } from "../../src/structure/nodes/index.js";

let query_year = (node) => {
    console.log("Query year for node:", node);
    if (node.id === "recent") {
        return {
            q: `_type=="${node.type}"`,
            opts: {
                limit: 100,
                order: {
                    by: "_createdAt",
                    desc: true,
                }
            }
        }
    }
    if (node.id === "upcoming") {
        return {
            q: `_type=="${node.type}" && start_date > "${new Date().getFullYear()}-${String(new Date().getMonth() + 1).padStart(2, '0')}-01"`,
            opts: {}
        }
    }

    return {
        q: `_type=="${node.type}" && start_date matches "${node.id}-*" `, // && start_date <= "${node.id}-12-31"
        opts: { limit: 10 }
    }
}

let tree = new node("root")
tree.children = [
    new node("booking", "Bookings", [
        new type_node("booking", "neue", "recent", query_year),
        new type_node("booking", "zukünftig", "upcoming", query_year),
        new type_node("booking", "2024", "2024", query_year),
        new type_node("booking", "2023", "2023", query_year),
    ]),
    new edit_node("usedom", "Options"),
    new type_node("booking", "All Bookings", "all-bookings"),
];

console.log("+++ project.js loaded", tree);

export default {
    previews: previews,
    structure: tree
};
