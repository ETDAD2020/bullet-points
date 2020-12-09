import React from "react";
import { Badge } from "@shopify/polaris";

export default function StatusBadge({ status }) {
    switch (status) {
        case "PENDING":
            return <Badge progress="partiallyComplete">Syncing</Badge>;
        case "SYNCED":
            return <Badge status="success">Synced</Badge>;
        default:
            return <Badge>Unknown</Badge>
    }
}
