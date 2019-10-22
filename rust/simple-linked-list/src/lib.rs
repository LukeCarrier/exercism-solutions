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
    fn from_iter<I: IntoIterator<Item = T>>(_iter: I) -> Self {
        unimplemented!()
    }
}

// In general, it would be preferable to implement IntoIterator for SimpleLinkedList<T>
// instead of implementing an explicit conversion to a vector. This is because, together,
// FromIterator and IntoIterator enable conversion between arbitrary collections.
// Given that implementation, converting to a vector is trivial:
//
// let vec: Vec<_> = simple_linked_list.into_iter().collect();
//
// The reason this exercise's API includes an explicit conversion to Vec<T> instead
// of IntoIterator is that implementing that interface is fairly complicated, and
// demands more of the student than we expect at this point in the track.

impl<T> Into<Vec<T>> for SimpleLinkedList<T> {
    fn into(self) -> Vec<T> {
        unimplemented!()
    }
}
