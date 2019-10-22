use std::{iter::FromIterator, mem};

pub struct Node<T> {
    element: T,
    next: Option<Box<Self>>,
}

impl<T> Node<T> {
    pub fn new(element: T) -> Self {
        Self {
            element,
            next: None,
        }
    }
}

pub struct SimpleLinkedList<T> {
    head: Option<Box<Node<T>>>,
}

impl<T> SimpleLinkedList<T> {
    pub fn new() -> Self {
        Self {
            head: None,
        }
    }

    pub fn len(&self) -> usize {
        let mut len = 0;
        let mut current_node = &self.head;
        while let Some(node) = current_node {
            len += 1;
            current_node = &node.next;
        }
        len
    }

    pub fn push(&mut self, element: T) {
        self.head = Some(Box::new(Node {
            element: element,
            next: mem::replace(&mut self.head, None)
        }));
    }

    pub fn pop(&mut self) -> Option<T> {
        self.head.take().map(|node| {
            self.head = node.next;
            node.element
        })
    }

    pub fn peek(&self) -> Option<&T> {
        self.head.as_ref().map(|n| &n.element)
    }

    pub fn rev(self) -> SimpleLinkedList<T> {
        unimplemented!()
    }
}

impl<T> FromIterator<T> for SimpleLinkedList<T> {
    fn from_iter<I: IntoIterator<Item = T>>(iter: I) -> Self {
        let mut result = SimpleLinkedList::new();
        for element in iter {
            result.push(element);
        }
        result
    }
}

impl<T> Into<Vec<T>> for SimpleLinkedList<T> {
    fn into(mut self) -> Vec<T> {
        let mut result = Vec::with_capacity(self.len());
        while let Some(element) = self.pop() {
            result.push(element);
        }
        result.reverse();
        result
    }
}
