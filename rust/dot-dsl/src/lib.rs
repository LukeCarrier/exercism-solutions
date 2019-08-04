use std::collections::HashMap;

pub fn hashmap_from_attrs(attrs: &[(&str, &str)]) -> HashMap<String, String> {
    let mut map = HashMap::new();
    for (key, value) in attrs {
        map.insert(key.to_string(), value.to_string());
    }
    map
}

pub mod graph {
    use std::collections::HashMap;

    pub struct Graph {
        pub edges: Vec<graph_items::edge::Edge>,
        pub nodes: Vec<graph_items::node::Node>,
        pub attrs: HashMap<String, String>,
    }

    impl Graph {
        pub fn new() -> Self {
            Self {
                edges: Vec::new(),
                nodes: Vec::new(),
                attrs: HashMap::new(),
            }
        }

        pub fn with_edges(self, edges: &Vec<graph_items::edge::Edge>) -> Self {
            Self {
                edges: edges.to_vec(),
                ..self
            }
        }

        pub fn with_nodes(self, nodes: &Vec<graph_items::node::Node>) -> Self {
            Self {
                nodes: nodes.to_vec(),
                ..self
            }
        }

        pub fn with_attrs(self, attrs: &[(&str, &str)]) -> Self {
            Self {
                attrs: crate::hashmap_from_attrs(attrs),
                ..self
            }
        }

        pub fn get_node(&self, label: &str) -> Option<&graph_items::node::Node> {
            self.nodes
                .iter()
                .find(|n| n.label == label)
        }
    }

    pub mod graph_items {
        pub mod edge {
            use std::collections::HashMap;

            #[derive(Debug, Clone, PartialEq)]
            pub struct Edge {
                pub start: String,
                pub end: String,
                pub attrs: HashMap<String, String>,
            }

            impl Edge {
                pub fn new(start: &str, end: &str) -> Self {
                    Self {
                        start: start.to_string(),
                        end: end.to_string(),
                        attrs: HashMap::new(),
                    }
                }

                pub fn with_attrs(self, attrs: &[(&str, &str)]) -> Self {
                    Self {
                        attrs: crate::hashmap_from_attrs(attrs),
                        ..self
                    }
                }

                pub fn get_attr(&self, attr: &str) -> Option<&str> {
                    self.attrs.get(attr).map(|v| v.as_str())
                }
            }
        }

        pub mod node {
            use std::collections::HashMap;

            #[derive(Debug, Clone, PartialEq)]
            pub struct Node {
                pub label: String,
                pub attrs: HashMap<String, String>,
            }

            impl Node {
                pub fn new(label: &str) -> Self {
                    Self {
                        label: label.to_string(),
                        attrs: HashMap::new(),
                    }
                }

                pub fn with_attrs(self, attrs: &[(&str, &str)]) -> Self {
                    Self {
                        attrs: crate::hashmap_from_attrs(attrs),
                        ..self
                    }
                }

                pub fn get_attr(&self, attr: &str) -> Option<&str> {
                    self.attrs.get(attr).map(|v| v.as_str())
                }
            }
        }
    }
}
